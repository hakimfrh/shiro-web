<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SensorData;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class JsonApiController extends Controller
{
    public function authenticate(Request $request)
    {
        if ($request->has("login") && $request->has("password")) {
            $login = $request->login;
            $password = $request->password;
        } else {
            return response()->json(['code' => '400', 'message' => 'Gak lengkap bro'], 400);
        }
        $credentials = [
            'username' => $login,
            'password' => $password,
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user)
                return response()->json(['code' => '200', 'message' => 'ok', 'user' => $user], 200);
        }
        return response()->json(['code' => '403', 'message' => 'Username atau password salah'], 401);
    }

    public function getData(Request $request)
    {
        if ($request->has("row")) {
            $history = SensorData::orderBy('timestamp', 'desc')->take($request->row)->get();
            return response()->json(['code' => '200', 'message' => 'ok', 'data' => $history], 200);
        }

        if ($request->has("date")) {
            $date = $request->date;
            $history = SensorData::whereDate('timestamp', $date)->orderBy('timestamp', 'desc')->get();

            if ($history->isEmpty()) {
                return response()->json(['code' => '204', 'message' => 'no data'], 204);
            }

            return response()->json(['code' => '200', 'message' => 'ok', 'data' => $history], 200);
        }

        if ($request->has('start_datetime')) {
            $startDatetime = $request->start_datetime;

            if ($request->has('limit')) {
                $limit = $request->limit;
                // Mengambil data berdasarkan start_datetime dan membatasi jumlah data
                $history = SensorData::where('timestamp', '>', $startDatetime)
                    ->orderBy('timestamp', 'desc')
                    ->take($limit)  // Membatasi jumlah data sesuai parameter limit
                    ->get();
            } else {
                $history = SensorData::where('timestamp', '>', $startDatetime)
                    ->orderBy('timestamp', 'desc')
                    ->get();
            }


            if ($history->isEmpty()) {
                return response()->json(['code' => '204', 'message' => 'no data'], 204);
            }

            return response()->json(['code' => '200', 'message' => 'ok', 'data' => $history], 200);
        }

        return response()->json(['code' => '400', 'message' => 'Gak lengkap bro'], 200);
    }

    public function classifyKoi(Request $request)
    {
        $publicPath = '';
        // Validasi apakah ada file yang diupload
        if ($request->has("base64") && $request->has("name")) {
            // Decode Base64 ke binary
            $base64File = $request->base64;
            $fileName = $request->name;
            $decodedFile = base64_decode($base64File);

            // Simpan file sementara di storage/public/classify
            date_default_timezone_set('Asia/Jakarta');
            $time = now();
            $customName = $time->format('Ymd_His') . '_' . $fileName;
            $path = 'classify/' . $customName;
            Storage::disk('public')->put($path, $decodedFile);

            // Dapatkan path publik untuk dikirim ke FastAPI
            $publicPath = $path;
        } else {
            $request->validate([
                'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            // Ambil file yang diupload
            $file = $request->file('file');

            // Simpan gambar sementara
            date_default_timezone_set('Asia/Jakarta');
            $time = now();
            $customName = $time->format('Ymd_His') . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('classify', $customName, 'public');

            // Dapatkan path publik untuk dikirim ke FastAPI
            $publicPath = 'classify/' . $customName;
        }


        // Kirim request ke FastAPI server
        try {
            $response = Http::post('http://127.0.0.1:8001/detect-koi', [
                'path' => $publicPath,
            ]);

            $data = $response->json();

            // Cek apakah respons FastAPI memiliki key "most_likely"
            if ($response->failed() || !isset($data['most_likely'])) {
                return response()->json([
                    'code' => '200',
                    'message' => $data['error'] ?? 'Respons dari FastAPI tidak valid.',
                    'response' => $data,
                ], 500);
            }

            return response()->json(['code' => '200', 'message' => 'ok', 'data' => $data], 200);

            $result = $data['most_likely'];
            // // Kembalikan hasil prediksi ke frontend
            // return response()->json([
            //     'class_name' => $result['class'],
            //     'confidence' => $result['confidence'],
            // ]);
        } catch (\Exception $e) {
            // Jika ada error, kembalikan pesan kesalahan
            return response()->json([
                'code' => '200',
                'message' => 'Terjadi kesalahan saat mengirim gambar ke FastAPI: ' . $e->getMessage(),
            ], 500);
        }
        // Hapus gambar setelah selesai
        Storage::disk('public')->delete($publicPath);
    }
}
