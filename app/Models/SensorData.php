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
        return $this->hasOne(Collar::class);
    }

    public function sensor()
    {
        return $this->hasOne(Sensor::class);
    }
}
