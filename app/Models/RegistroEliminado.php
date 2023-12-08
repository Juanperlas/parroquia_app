<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroEliminado extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_registro',
        'fecha_eliminacion',
        'justificacion',
    ];

    public function registroBautizo()
    {
        return $this->belongsTo(RegistroBautizo::class, 'numero_registro', 'numero_registro');
    }
}
