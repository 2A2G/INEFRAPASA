<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;
    protected $primaryKey = 'curso_id';
    protected $fillable = [
        'nombreCurso',
        'estado_id',
    ];

    public function estudiante()
    {
        return $this->hasMany(Estudiante::class, 'curso_id');
    }

    //un cargo puede tener un solo estado
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }

    //un curso puede tener muchos postulantes
    public function postulante()
    {
        return $this->hasMany(Postulante::class, 'curso_id');
    }
}
