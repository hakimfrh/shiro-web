<?php

namespace App\Http\Controllers;

use App\Models\KoiDetection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class KoiDetectionController extends Controller
{
    public function showForm()
    {
        return view('detect_koi', [
            'title' => 'Deteksi Jenis Ikan Koi'
        ]);
    }

    public function classifyKoi(Request $request)
{
    // Validasi apakah ada file yang diupload
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

    // Kirim request ke FastAPI server
    try {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->post('http://127.0.0.1:8001/detect-koi', [
            'path' => $publicPath,
        ]);

        $data = $response->json();

        // Cek apakah respons FastAPI memiliki key "most_likely"
        if ($response->failed() || !isset($data['most_likely'])) {
            return response()->json([
                'error' => $data['error'] ?? 'Respons dari FastAPI tidak valid.',
                'response' => $data,
            ], 500);
        }

        $result = $data['most_likely'];

        // Kembalikan hasil prediksi ke frontend
        return response()->json([
            'class_name' => $result['class'],
            'confidence' => $result['confidence'],
        ]);

    } catch (\Exception $e) {
        // Jika ada error, kembalikan pesan kesalahan
        return response()->json([
            'error' => 'Terjadi kesalahan saat mengirim gambar ke FastAPI: ' . $e->getMessage(),
        ], 500);
    }
}

}


    // Contoh fungsi untuk mendeteksi jenis ikan koi dengan machine learning (opsional)
    // private function detectKoiType($imagePath)
    // {
    //     // Logika untuk deteksi menggunakan model machine learning
    //     // Kirim gambar ke model dan dapatkan hasil
    //     return [
    //         'type' => 'Contoh Jenis Koi',
    //     ];
    // }
