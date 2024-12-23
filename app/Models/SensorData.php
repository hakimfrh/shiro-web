<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SensorData extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dengan nama model
    protected $table = 'sensor_data';

    // Jika tabel tidak memiliki kolom created_at dan updated_at
    public $timestamps = false;

    // Tentukan kolom yang dapat diisi
    protected $fillable = ['temperature', 'tds', 'ph', 'timestamp'];
}
