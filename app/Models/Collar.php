<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collar extends Model
{
    use HasFactory;

    protected $fillable = [
        'sensores_data',
    ];

    public function pets()
    {
        return $this->belongsTo(Pet::class, 'id_collar');
    }

    public function sensorData()
    {
        return $this->belongsTo(SensorData::class);
    }
}
