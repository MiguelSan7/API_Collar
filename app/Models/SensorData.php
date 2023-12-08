<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SensorData extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_sensor', 'valor',
    ];

    public function collar()
    {
        return $this->belongsTo(Collar::class, 'id_sensoresdata');
    }

    public function sensor()
    {
        return $this->belongsTo(Sensor::class, 'id_sensor');
    }
}
