<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postulante extends Model
{
    use HasFactory;
    protected $primaryKey = 'postulante_id';
    protected $fillable = [
        'estudiante_id',
        'cargo_id',
        'fotoPostulante',
        'estado_id',
    ];

    // Un postulante pertenece a un curso
    public function curso()
    {
        return $this->belongsTo(Curso::class, 'curso_id', 'curso_id');
    }
    // Un postulante pertenece a un cargo
    public function cargo()
    {
        return $this->belongsTo(Cargo::class, 'cargo_id', 'cargo_id');
    }

    //Un postulante pertenece a un estudiante
    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'estudiante_id');
    }

    //Un cargo puede tener un solo estado
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }

    //Un postulante puede tener muchos votos
    public function voto()
    {
        return $this->hasMany(Voto::class);
    }

    //Un postulante puede una sola foto
    public function photo()
    {
        return $this->hasOne(Photo::class, 'postulante_id', 'postulante_id');
    }
}
