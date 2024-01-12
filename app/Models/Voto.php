<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voto extends Model
{
    use HasFactory;

    protected $primaryKey = 'voto_id';
    protected $filable = [
        'postulante_id',
        'cargo_id',
        'cantidadVotos',
        'estado_id',
    ];

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    public function postulante()
    {
        return $this->belongsTo(Postulante::class);
    }
}
