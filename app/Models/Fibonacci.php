<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fibonacci extends Model
{
    //
    protected $table = 'fibonaccis';
    protected $fillable = ['valor'];
}
