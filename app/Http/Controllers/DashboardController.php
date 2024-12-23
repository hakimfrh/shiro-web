<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SensorData;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data terbaru untuk real-time display
        $latestData = SensorData::latest('timestamp')->first();

        // Ambil riwayat data (10 entri terakhir)
        $history = SensorData::orderBy('timestamp', 'desc')->take(10)->get();

        // Kirim data ke view
        return view('dashboard.index', [
            'title' => 'Dashboard',
            'latestData' => $latestData,
            'history' => $history,
        ]);
    }
}
