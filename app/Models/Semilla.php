<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Numeros;
class Semilla extends Model
{
    //

    protected $fillable = [
        'v1',
        'v2',
        'm',
        'metodo',
    ];

    public function numeros()
    {
        return $this->hasMany('App\Models\Numeros', 'semilla_id', 'id');
    }
}
