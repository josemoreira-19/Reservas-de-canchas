<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    Protected $fillable =[
        'fecha',
        'hora_inicio',
        'hora_fin',
        'estado',   
    ];

    public function Canchas(){
        return $this->belongsTo(canchas::class);
    }   
    public function Pagos(){
        return $this->hasOne(pagos::class);
    }

    public function user(){
        return $this->belongsTo(user::class);
    }
}
