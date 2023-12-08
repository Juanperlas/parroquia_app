<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroBautizo extends Model
{
    use HasFactory;

    protected $primaryKey = 'numero_registro';

    protected $fillable = [
        'nombre',
        'padre',
        'madre',
        'padrino',
        'madrina',
        'fecha_bautizo',
        'lugar_bautizo',
        'sacerdote',
    ];

    public function registroEliminado()
    {
        return $this->hasOne(RegistroEliminado::class, 'numero_registro', 'numero_registro');
    }
}
