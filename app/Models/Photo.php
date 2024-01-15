<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    protected $primaryKey = 'photo_id';
    protected $fillable = [
        'imagenCandidato',
        'postulante_id',
        'estado_id',
    ];

    //Una foto pertenece a un postulante
    public function postulante()
    {
        return $this->belongsTo(Postulante::class, 'postulante_id', 'postulante_id');
    }

    //Una foto tiene un estado
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }
}
