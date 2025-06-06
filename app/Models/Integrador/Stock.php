<?php

namespace App\Models\Integrador;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    
    protected $table = 'stocks';
    protected $fillable = [
        'cantidad_actual',
        'producto',
    ];

    // Relación uno a muchos con el modelo Demanda
    public function demandas()
    {
        return $this->hasMany(Demanda::class, 'stock_id');
    }


}
