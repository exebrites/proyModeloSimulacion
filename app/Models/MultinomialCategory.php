<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MultinomialCategory extends Model
{
    protected $fillable = ['name'];

    public function results(): BelongsToMany
    {
        return $this->belongsToMany(
            MultinomialResult::class,
            'multinomial_result_category', // nombre de la tabla pivote
            'category_id',  // FK en la tabla pivote para MultinomialCategory
            'result_id',    // FK en la tabla pivote para MultinomialResult
        )->withPivot(['count', 'theoretical_probability']);
    }
}
