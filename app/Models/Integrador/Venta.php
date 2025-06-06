<?php

namespace App\Models\Integrador;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    //
    protected $table = 'ventas';

    protected $fillable = [
        'demanda_id',
        'cantidad',
        'fecha',
    ];

    // Relación uno a uno con el modelo Demanda
    public function demanda()
    {
        return $this->belongsTo(Demanda::class, 'demanda_id');
    }
    // Relación uno a muchos con el modelo Movimiento
    public function movimientos()
    {
        return $this->hasMany(Movimiento::class, 'venta_id');
    }
}
