<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_cargo',
        'descripcion_cargo',
    ];

    // Relación con los postulantes
    public function postulantes()
    {
        return $this->hasMany(Postulante::class);
    }
}
