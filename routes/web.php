<?php

use App\Http\Controllers\CongruenciaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FibonacciController;

Route::get('/', function () {
    return view('Home');
})->name('home');

Route::post('/fibonacci/metodo', [FibonacciController::class, 'metodoFibonacci'])->name('metodoFibonacci');
Route::get('/fibonacci', [FibonacciController::class, 'index'])->name('fibonacci');

Route::get('/congruencia', [CongruenciaController::class, 'index'])->name('congruencia');
Route::get('/congruencia/metodo', [CongruenciaController::class, 'metodoCongruencia'])->name('metodoCongruencia');
//cambiar por POST
Route::post('/congruencia/mixto', [CongruenciaController::class, 'metodoCongruenciaMixto'])->name('metodoCongruenciaMixto'); 
