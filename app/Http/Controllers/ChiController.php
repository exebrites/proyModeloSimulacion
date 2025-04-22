<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fibonacci;
class ChiController extends Controller
{
    public function index()
    {
        // return view('chi');
        return 'index chi';
    }

    public function agrupacionNumerosAleatorios($numeroGenerados)
    {

        $numerosAgrupados = [];
        foreach ($numeroGenerados as $key => $value) {
            array_push($numerosAgrupados, $value->valor);
        }

        $secuenciaAgrupacion = "";
        //generar secuencia fibonacci
        foreach ($numerosAgrupados as $key => $value) {
            $aux = strval($value);
            $secuenciaAgrupacion .= $aux;
        }
        return $secuenciaAgrupacion;
    }

    public function testChiCuadrado($n)
    {
        //declaracion de variables
        // cantidad de numeros 
        $n= 55;
        $k = 10; //total de numero en el intervalo 0 a 9
        // n / pi
        $npi = $n / $k;
        // grados de libertad
        $gl = 9;
        // valor de chi cuadrado critico
        $chiCuadradoCritico = 14.6837;
        // valor de chi cuadrado calculado
        $chiCuadradoCalculado = 0;

        //frecuencia observada
        $fibonacci = Fibonacci::orderBy('created_at', 'desc')->take($n)->get();
        $secuenciaFibonacci = $this->agrupacionNumerosAleatorios($fibonacci);

        $frecuenciaObservada = array_fill(0, 10, 0);

        for ($i = 0; $i < strlen($secuenciaFibonacci); $i++) {
            $valor = intval($secuenciaFibonacci[$i]);
            $frecuenciaObservada[$valor]++;
        }
        // $frecuenciaObservada = []
        // dd($frecuenciaObservada);
        $frecuenciaObservada = [
            '0'=>7,
            '1'=>4,
            '2'=>5,
            '3'=>7,
            '4'=>4,
            '5'=>5,
            '6'=>4,
            '7'=>9,
            '8'=>5,
            '9'=>5];
      
        //calcular chi cuadrado calculado 
        foreach ($frecuenciaObservada as $key => $value) {
            // dd($value);
            $chiCuadradoCalculado += pow(($value - $npi), 2) / $npi;
        }

        dd($chiCuadradoCalculado);
        // return $frecuenciaObservada;
        if ($chiCuadradoCalculado <= $chiCuadradoCritico) {
            # code...
            return 'aceptar hipotesis nula';
        } else {
            # code...
            return 'rechazar hipotesis nula';
        }

        return $secuenciaFibonacci;
        return 'chi cuadrado';
    }
}
