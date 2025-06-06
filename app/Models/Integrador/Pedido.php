<?php

namespace App\Models\Integrador;

use Illuminate\Database\Eloquent\Model;
use App\Models\Numeros;

class Pedido extends Model
{
    
    protected $table = 'pedidos';
    protected $fillable = [
    
        'numero_id',
        'cantidad_solicitada',
        'cantidad_recibida',
        'estado',
        'demora',
        'fecha_solicitud',
        'fecha_recibida',
    ];
    

    //relacion uno a uno con numeros
    public function numero()
    {
        return $this->belongsTo(Numeros::class, 'numero_id');
    }
    //relacion uno a uno con movimiento
    public function movimiento()
    {
        return $this->hasOne(Movimiento::class, 'pedido_id');
    }
}
