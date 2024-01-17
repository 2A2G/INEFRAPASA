<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class conteoVoto extends Model
{
    use HasFactory;
    protected $primaryKey = 'conteoVotos_id';
    protected $filable = [
        'postulante_id',
        'cargo_id',
        'estado_id',
        'totalVotos',
    ];

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    public function postulante()
    {
        return $this->belongsTo(Postulante::class);
    }

    public function cargo()
    {
        return $this->belongsTo(Cargo::class);
    }
    
}
