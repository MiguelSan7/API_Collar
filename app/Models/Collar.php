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
        return $this->hasMany(Pet::class, 'collar_id');
    }

    public function sensorData()
    {
        return $this->hasOne(SensorData::class, 'id_sensoresdata');
    }
}
