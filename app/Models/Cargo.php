<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;
    protected $primaryKey = 'estado_id';
    protected $fillable = [
        'nombreCargo',
        'descripcionCargo'
    ];

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    public function postulantes()
    {
        return $this->hasMany(Postulante::class);
    }
}
