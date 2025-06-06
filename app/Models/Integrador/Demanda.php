<?php

namespace App\Models\Integrador;

use Illuminate\Database\Eloquent\Model;
use App\Models\Numeros;
use App\Models\Integrador\Stock;
class Demanda extends Model
{
    //
    protected $table = 'demandas';
    protected $fillable = [
        'numero_id',
        'stock_id',
        'cantidad_solicitada',
        'cantidad_cubierta',
        'estado',
        'fecha',
    ];

    // Relación uno a uno con el modelo Numeros
    public function numero()
    {
        return $this->belongsTo(Numeros::class, 'numero_id');
    }
    // Relación uno a muchos con el modelo Stock
    public function stocks()
    {
        return $this->belongsTo(Stock::class, 'stock_id');
    }

    // Relación uno a uno con el modelo Venta
    public function venta()
    {
        return $this->hasOne(Venta::class, 'demanda_id');
    }
}
