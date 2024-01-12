<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;
    protected $filiable = [
        'cargo_id',
        'estado_id',
        'nombreCargo',
        'descripcionCargo'
    ];

    public function estado(){
        return $this->belongsTo(Estado::class);
    }

    public function postulante(){
        return $this->hasMany(Postulante::class);
    }
}
