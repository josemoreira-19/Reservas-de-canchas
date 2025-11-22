<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class canchas extends Model
{
    protected $fillable = [
        'nombre',
        'tipo',
        'precio_por_hora',
        'estado',
    ];

    public function Reservas()
    {
        return $this->hasMany(reservas::class);
    }
}
