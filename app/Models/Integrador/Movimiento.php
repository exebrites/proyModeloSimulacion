<?php

namespace App\Models\Integrador;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    
    protected $table = 'movimientos';
    protected $fillable = [
        'venta_id', 
        'pedido_id',
        'stock_id',
        'tipo',
        'cantidad',

    ];

    // Relación uno a uno con el modelo Venta
    public function venta()
    {
        return $this->belongsTo(Venta::class, 'venta_id');
    }
    // Relación uno a uno con el modelo Pedido
    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'pedido_id');
    }

    // Relación uno a muchos con el modelo Stock
    public function stock()
    {
        return $this->belongsTo(Stock::class, 'stock_id');
    }
}
