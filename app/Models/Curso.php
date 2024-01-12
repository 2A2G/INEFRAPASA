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
        return $this->hasMany(Estudiante::class);
    }

    //un cargo puede tener un solo estado
    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }
    
}
