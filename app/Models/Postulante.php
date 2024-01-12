<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postulante extends Model
{
    protected $fillable = [
        'numeroIdentificacion_id',
        'cargo_id',
        'fotoPostulante',
        'estado_id',
    ];

    // Un postulante pertenece a un cargo
    public function cargo()
    {
        return $this->belongsTo(Cargo::class, 'cargo_id');
    }

    //Un postulante pertenece a un estudiante
    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'numeroIdentificacion_id');
    }

    //Un cargo puede tener un solo estado
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }

    //Un postulante puede tener muchos votos
    public function voto()
    {
        return $this->hasMany(Voto::class, 'postulante_id');
    }
}
