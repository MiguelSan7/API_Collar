<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'peso', 'collar_id', 'dueño',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'dueño');
    }

    public function collar()
    {
        return $this->belongsTo(Collar::class, 'collar_id');
    }
}
