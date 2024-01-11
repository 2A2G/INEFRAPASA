<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postulante extends Model
{
    use HasFactory;
    protected $fillable = [
        'numero_identificacion_postulante',
        'nombre_postulante',
        'cargo_id ',
        'foto_postulante',
        'curso_postulante',
        'votos_postulante',
        'estado_postulante',
    ];

    // Relación inversa con los cargos
    public function cargo()
    {
        return $this->belongsTo(Cargo::class, 'cargo_id');
    }
}
