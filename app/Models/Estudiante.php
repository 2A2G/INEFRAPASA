<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;
    protected $fillable = [
        'numeroIdentificacion',
        'nombreCompleto',
        'curso',
        'sexo',
        'estado',
    ];
    public function votacion()
    {
        return $this->hasOne(Votacion::class, 'id_estudiante', 'id');
    }
}
