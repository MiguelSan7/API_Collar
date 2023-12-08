<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'unidad_medida',
    ];

    public function sensorData()
    {
        return $this->hasMany(SensorData::class, 'id_sensor');
    }
}
