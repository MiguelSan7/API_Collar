<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'peso', 'id_collar', 'id_usuario',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function collar()
    {
        return $this->belongsTo(Collar::class, 'id_collar');
    }
}
