<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pagos extends Model
{
    Protected $fillable =[
        'monto',
        'metodo',
        'pago',
    ];

    public function Reservas(){
        return $this->belongsTo(reservas::class);
    }

}
