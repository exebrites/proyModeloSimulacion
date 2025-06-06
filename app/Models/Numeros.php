<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Integrador\Pedido;
use App\Models\Integrador\Demanda;
class Numeros extends Model
{
    protected $fillable = [
        'resultado',
    ];

    public function semilla()
    {
        return $this->belongsTo(Semilla::class);
    }

    
    // Relacion uno a uno con Pedido
    public function pedido()
    {
        return $this->hasOne(Pedido::class, 'numero_id');
    }

    //relacion uno a uno con Demanda
    public function demanda()
    {
        return $this->hasOne(Demanda::class, 'numero_id');
    }

}
