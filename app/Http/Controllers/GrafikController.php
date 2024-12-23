<?php

namespace App\Http\Controllers;

use App\Models\Control;
use Illuminate\Http\Request;
use App\Models\SensorData;

class GrafikController extends Controller
{
    

    public function index(Request $request)
{
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    // Ambil data dari sensor_data berdasarkan rentang tanggal
    $monitoringData = SensorData::whereBetween('timestamp', [$startDate, $endDate])
        ->orderBy('timestamp', 'asc')  // Urutkan berdasarkan timestamp
        ->get();

    // Format data untuk dikirim ke view
    $monitoringDataFormatted = $monitoringData->map(function ($item) {
        return [
            'timestamp' => $item->timestamp,
            'temperature' => $item->temperature,
            'tds' => $item->tds,
            'ph' => $item->ph,
        ];
    });

    return view('grafik', [
        'monitoringData' => $monitoringDataFormatted,
        'title' => 'Grafik Monitoring',  // Menambahkan variabel $title
    ]);
}

    

}
