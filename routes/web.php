<?php

use App\Http\Controllers\CongruenciaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FibonacciController;
use App\Http\Controllers\RachasController;
use App\Http\Controllers\ChiController;
use App\Http\Controllers\DistribucionController;
Route::get('/', function () {
    return view('Home');
})->name('home');

Route::post('/fibonacci/metodo', [FibonacciController::class, 'metodoFibonacci'])->name('metodoFibonacci');
Route::get('/fibonacci', [FibonacciController::class, 'index'])->name('fibonacci');

Route::get('/congruencia', [CongruenciaController::class, 'index'])->name('congruencia');
Route::get('/congruencia/metodo', [CongruenciaController::class, 'metodoCongruencia'])->name('metodoCongruencia');
//cambiar por POST
Route::post('/congruencia/mixto', [CongruenciaController::class, 'metodoCongruenciaMixto'])->name('metodoCongruenciaMixto'); 

Route::get('/rachas/{n}',[RachasController::class, 'testTachas'])->name('rachas');
Route::get('/chi/{n}',[ChiController::class, 'testChiCuadrado'])->name('chi');

// Distribuciones
Route::get('/distribuciones', [DistribucionController::class, 'index'])->name('distribuciones');
Route::get('/distribuciones/multinomial', [DistribucionController::class, 'multinomialIndex'])->name('distribuciones.multinomial.index');
Route::post('/distribuciones/multinomial/calcular', [DistribucionController::class, 'calcularMultinomial'])->name('distribuciones.multinomial.calcular');

// D. Normal
Route::get('/distribuciones/normal', [DistribucionController::class, 'normalIndex'])->name('distribuciones.normal.index');
Route::post('/distribuciones/normal/calcular', [DistribucionController::class, 'calcularNormal'])->name('distribuciones.normal.calcular');
