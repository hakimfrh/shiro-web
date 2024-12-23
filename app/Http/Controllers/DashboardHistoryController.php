<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SensorData;
use Barryvdh\DomPDF\Facade as PDF;

class DashboardHistoryController extends Controller
{
    public function index(Request $request)
    {
        // Ambil filter tanggal dari request (jika ada)
        $filterDate = $request->input('filter');

        // Filter data berdasarkan tanggal jika tersedia
        $controls = $filterDate
            ? SensorData::whereDate('timestamp', $filterDate)->orderBy('timestamp', 'desc')->get()
            : SensorData::orderBy('timestamp', 'desc')->get();

        // Kirim data ke view
        return view('dashboard.histories.index', [
            'title' => 'Rekap Data',
            'controls' => $controls,
            'today' => now()->format('Y-m-d'),
        ]);
    }

    public function destroy($id)
    {
        // Hapus data berdasarkan ID
        $data = SensorData::findOrFail($id);
        $data->delete();

        return redirect()->route('dashboard.histories.index')->with('success', 'Data berhasil dihapus!');
    }

    public function cetak(Request $request)
    {
        // Ambil filter tanggal dari request
        $filterDate = $request->input('filter');

        // Filter data atau ambil semua
        $controls = $filterDate
            ? SensorData::whereDate('timestamp', $filterDate)->orderBy('timestamp', 'desc')->get()
            : SensorData::orderBy('timestamp', 'desc')->get();

        // Muat view cetak ke dalam PDF
        $pdf = PDF::loadView('dashboard.histories.cetak', [
            'controls' => $controls,
            'filterDate' => $filterDate,
        ]);

        // Tampilkan PDF di browser
        return $pdf->stream('Rekap_Monitoring_' . ($filterDate ?? now()->format('Y-m-d')) . '.pdf');
    }
}
