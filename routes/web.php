<?php

use App\Http\Controllers\CongruenciaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FibonacciController;
use App\Http\Controllers\RachasController;
use App\Http\Controllers\ChiController;
use App\Http\Controllers\DistribucionController;
use App\Http\Controllers\MonteCarloController;
use App\Models\Semilla;
use App\Services\MonteCarloService;

Route::get('/', function () {
  return view('Home');
})->name('home');

// Ruta para numeros aleatorios
Route ::get('/numeros-aleatorios', function () {
  return view('NumerosAleatorios');
})->name('numerosAleatorios');

Route::post('/fibonacci/metodo', [FibonacciController::class, 'metodoFibonacciExtendido'])->name('metodoFibonacci');
// Route::post('/fibonacci/metodo', [FibonacciController::class, 'metodoFibonacci'])->name('metodoFibonacci');
Route::get('/fibonacci', [FibonacciController::class, 'index'])->name('fibonacci');
Route::get('/create', [FibonacciController::class, 'fibonacci'])->name('fibonacci.create');
Route::get('/fibonacci/{id}', [FibonacciController::class, 'show'])->name('fibonacci.show');



Route::get('/congruencia', [CongruenciaController::class, 'index'])->name('congruencia');
Route::get('/congruencia/metodo', [CongruenciaController::class, 'metodoCongruencia'])->name('metodoCongruencia');
//cambiar por POST
Route::post('/congruencia/mixto', [CongruenciaController::class, 'metodoCongruenciaMixto'])->name('metodoCongruenciaMixto');

Route::get('/rachas/{n}', [RachasController::class, 'testTachas'])->name('rachas');
Route::get('/chi/{n}', [ChiController::class, 'testChiCuadrado'])->name('chi');

// Distribuciones
Route::get('/distribuciones', [DistribucionController::class, 'index'])->name('distribuciones');
Route::get('/distribuciones/multinomial', [DistribucionController::class, 'multinomialIndex'])->name('distribuciones.multinomial.index');
Route::post('/distribuciones/multinomial/calcular', [DistribucionController::class, 'calcularMultinomial'])->name('distribuciones.multinomial.calcular');

// D. Normal
Route::get('/distribuciones/normal', [DistribucionController::class, 'normalIndex'])->name('distribuciones.normal.index');
Route::post('/distribuciones/normal/calcular', [DistribucionController::class, 'calcularNormal'])->name('distribuciones.normal.calcular');


Route::get('/montecarlo',[MonteCarloController::class, 'index'])->name('montecarlo');
Route::post('/montecarlo', [MonteCarloController::class, 'montecarlo'])->name('montecarlo.montecarlo');
Route::get('/monte', function (MonteCarloService $monteCarloService,) {

  //marca de clases
  $media = 170;
  $desviacionEstandar = 10;
  $numeroMarcasClases = 4;
  $porcentajeValoresExtremos = 0.95;

  $monte = $monteCarloService->generadorMarcasClases(
    $media,
    $desviacionEstandar,
    $numeroMarcasClases,
    $porcentajeValoresExtremos
  );
  // return $monte;
  $marcas = $monte['marcasClases'];


  // return $marcas;
  //numeros aleatorios
  // $numeros = [
  //   0.84,
  //   0.13,
  //   0.79,
  //   0.56,
  //   0.73,
  //   0.14,
  //   0.64,
  //   0.13,
  //   0.71,
  //   0.57,
  //   0.51,
  // ];
$semilla = Semilla::where('metodo', 'fibonacci')->find(1);
$numeros = $semilla->numeros;

// dd($semilla,$numeros);
  $muestra = $monteCarloService->conversionNumerosZ($numeros, $media, $desviacionEstandar);
 

  // clasificar 
// return $marcas;
  $clasificacion = $monteCarloService->clasificarNumeros($muestra, $marcas);
  return $clasificacion;


})->name('graficas');
