<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    use HasFactory;

    protected $table = 'monitoring';

    protected $fillable = [
        'temperature',  // Suhu air
        'turbidity',    // TDS
        'ph',           // Tingkat keasaman
        'notification', // Status notifikasi
    ];
}
