<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;
    protected $fillable = [
        'estado_id',
        'nombreEstado',
    ];

    // Un esstado puede tener muchos estudiantes
    public function estudiantes()
    {
        return $this->hasMany(Estudiante::class, 'estado_id');
    }
    
    //Un estado puede tener muchos cursos
    public function cursos()
    {
        return $this->hasMany(Curso::class, 'estado_id');
    }

    //Un estado puede tener muchos cargos
    public function cargos()
    {
        return $this->hasMany(Cargo::class, 'estado_id');
    }

    //Un estado puede tener muchos postulantes
    public function postulantes()
    {
        return $this->hasMany(Postulante::class, 'estado_id');
    }

    //Un estado puede tener muchas votaciones
    public function votos()
    {
        return $this->hasMany(Voto::class, 'estado_id');
    }
}
