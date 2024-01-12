<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;
    protected $fillable = [
        'numeroIdentificacion_id',
        'nombreCompleto',
        'curso',
        'sexo',
        'estado_id',
    ];

    public function postulante()
    {
        return $this->hasOne(Postulante::class, 'numeroIdentificacion_id', 'numeroIdentificacion_id');
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'curso_id');
    }

    //un cargo puede tener un solo estado
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }
}
