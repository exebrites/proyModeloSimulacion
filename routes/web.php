<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FibonacciController;

Route::get('/', function () {
    return view('welcome');
});
Route::post('/fibonacci/metodo', [FibonacciController::class, 'metodoFibonacci'])->name('metodoFibonacci');
Route::get('/fibonacci', [FibonacciController::class, 'index'])->name('fibonacci');