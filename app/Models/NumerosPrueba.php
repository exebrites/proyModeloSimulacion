<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NumerosPrueba extends Model
{
    use HasFactory;

    // Nombre de la tabla asociada al modelo
    protected $table = 'numeros_prueba';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'resultado',
        'semilla_prueba_id', // ¡Importante! Asegúrate de que coincida con el nombre de la columna de la clave foránea
    ];

    /**
     * Define la relación inversa uno a muchos (BelongsTo) con SemillaPrueba.
     * Un NumeroPrueba pertenece a una SemillaPrueba.
     */
    public function semilla(): BelongsTo
    {
        return $this->belongsTo(SemillaPrueba::class, 'semilla_prueba_id');
    }

    
}
