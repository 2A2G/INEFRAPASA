<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'estudiante_id';
    protected $fillable = [
        'numeroIdentificacion',
        'nombreCompleto',
        'curso',
        'sexo',
        'estado_id',
    ];

    public function postulante()
    {
        return $this->hasOne(Postulante::class);
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    //un cargo puede tener un solo estado
    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }
}
