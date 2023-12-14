<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collar extends Model
{
    use HasFactory;

    protected $fillable = [

    ];

    public function pets()
    {
        return $this->belongsTo(Pet::class, 'collar');
    }

    public function sensorData()
    {
        return $this->belongsTo(SensorData::class,'collar');
    }
}
