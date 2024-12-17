<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'paterno', 'materno'];

    // Relación uno a muchos con Telefonos
    public function telefonos()
    {
        return $this->hasMany(Telefono::class);
    }

    // Relación uno a muchos con Direcciones
    public function direcciones()
    {
        return $this->hasMany(Direccion::class);
    }

}
