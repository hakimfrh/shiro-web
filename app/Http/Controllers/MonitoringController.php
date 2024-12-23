<?php

namespace App\Http\Controllers;

use App\Events\MyEvent;
use App\Models\Monitoring;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    public function bacasuhu()
    {
        $monitoring = Monitoring::select('temperature')->get();
        return view('bacasuhu', ['monitoring' => $monitoring]);
    }

    public function bacaph()
    {
        $monitoring = Monitoring::select('ph')->get();
        return view('bacaph', ['monitoring' => $monitoring]);
    }

    public function bacatds()
    {
        $monitoring = Monitoring::select('turbidity')->get();
        return view('bacatds', ['monitoring' => $monitoring]);
    }

    public function simpan()
    {
        $notification = Monitoring::select('notification')->first()->notification;
        $temperature = request('temperature');
        $turbidity = request('turbidity');
        $ph = request('ph');

        $telegramToken = 'YOUR_TELEGRAM_TOKEN';
        $chatId = 'YOUR_CHAT_ID'; 

        // Inisialisasi klien Telegram Bot
        $telegram = new \Telegram\Bot\Api($telegramToken);

        $messages = [];

        if ($temperature < 25 || $temperature > 30) {
            $messages[] = 'Suhu Air: ' . $temperature . ' °C';
        }

        if ($turbidity > 400) {
            $messages[] = 'Kekeruhan Air (TDS): ' . $turbidity . ' NTU';
        }

        if ($ph < 6 || $ph > 9) {
            $messages[] = 'pH Air: ' . $ph;
        }

        $message = implode(', ', $messages);

        // Notifikasi agar tidak terkirim setiap menit
        if (!empty($messages) && $notification == false) {
            $telegram->sendMessage([
                'chat_id' => $chatId,
                'text' => $message,
            ]);
            $notification = true;
        } else {
            $notification = false;
        }

        Monitoring::where('id', 1)->update([
            'notification' => $notification,
            'temperature' => $temperature,
            'turbidity' => $turbidity,
            'ph' => $ph,
        ]);
    }
}
