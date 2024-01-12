<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;
    protected $fillable = [
        'curso_id',
        'nombreCurso',
        'estado_id',
    ];

    public function estudiante()
    {
        return $this->hasMany(Estudiante::class, 'curso_id', 'curso_id');
    }

    //un cargo puede tener un solo estado
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }
    
}
