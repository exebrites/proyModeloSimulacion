<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SemillaPrueba extends Model
{
    protected $table = 'semillas_pruebas';

    protected $fillable = [
        'v1',
        'v2',
        'm',
        'metodo',
    ];

    /**
     * Define la relación uno a muchos con NumerosPrueba.
     * Una SemillaPrueba puede tener muchos NumerosPrueba asociados.
     */
    public function numeros(): HasMany
    {
        return $this->hasMany(NumeroPrueba::class, 'semilla_prueba_id');
    }
}
