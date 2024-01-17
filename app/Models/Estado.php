<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;
    protected $primaryKey = 'estado_id';
    protected $fillable = [
        'nombreEstado',
    ];

    // Un estado puede tener muchos estudiantes
    public function estudiantes()
    {
        return $this->hasMany(Estudiante::class);
    }

    // Un estado puede tener muchos cursos
    public function cursos()
    {
        return $this->hasMany(Curso::class);
    }

    // Un estado puede tener muchos cargos
    public function cargos()
    {
        return $this->hasMany(Cargo::class);
    }

    // Un estado puede tener muchos postulantes
    public function postulantes()
    {
        return $this->hasMany(Postulante::class);
    }

    // Un estado puede tener muchas votaciones
    public function votos()
    {
        return $this->hasMany(Voto::class);
    }

    // Un estado puede tener muchas fotos
    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    // Un estado puede tener muchos conteos de votos
    public function conteoVotos()
    {
        return $this->hasMany(conteoVoto::class);
    }
}
