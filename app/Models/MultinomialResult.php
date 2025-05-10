<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MultinomialResult extends Model
{
    protected $fillable = ['ensayos'];

    // Relación muchos-a-muchos con categorías (a través de la tabla pivote)
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            MultinomialCategory::class,
            'multinomial_result_category', // nombre de la tabla pivote
            'result_id',    // FK en la tabla pivote para MultinomialResult
            'category_id',  // FK en la tabla pivote para MultinomialCategory
        )->withPivot(['count', 'theoretical_probability']);
    }
}
