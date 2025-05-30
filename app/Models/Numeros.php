<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Numeros extends Model
{
    protected $fillable = [
        'resultado',
    ];

    public function semilla()
    {
        return $this->belongsTo(Semilla::class);
    }

    
}
