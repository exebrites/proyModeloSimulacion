<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fibonacci;
use Illuminate\Database\Console\DumpCommand;

class RachasController extends Controller
{

    public function agrupacionNumerosAleatorios($fibonacci)
    {

        $numerosFibonacci = [];
        foreach ($fibonacci as $key => $value) {
            array_push($numerosFibonacci, $value->valor);
        }

        $secuenciaFibonnacci = "";
        //generar secuencia fibonacci
        foreach ($numerosFibonacci as $key => $value) {
            $aux = strval($value);
            $secuenciaFibonnacci .= $aux;
        }
        return $secuenciaFibonnacci;
    }

    public function generacionSecuenciaBits($secuenciaFibonacci)
    {
        for ($i = 0; $i < strlen($secuenciaFibonacci); $i++) {
            # code...
            $valor = $secuenciaFibonacci[$i];
            // return $valor;

            // si valor >=0 y valor <= 4 => 0 SINO 1
            if ($valor >= 0 && $valor <= 4) {
                $secuenciaBits[] = 0;
            } else {
                $secuenciaBits[] = 1;
            }
        }
        return $secuenciaBits;
    }
    public function contadorRachas($secuenciaBits, $evaluador, $descontinuador, $indice)
    {

        $rachas = 0;
        $aux = 0;
        $length = count($secuenciaBits);

        for ($j = $indice; $j < $length; $j++) {
            // foreach ($secuenciaBits as $key => $bit) {
            # code...
            // dd($j, $length, $secuenciaBits[$j], $evaluador);
            if ($secuenciaBits[$j] !== $evaluador) {
                // dd("continue");    
                continue;
            }
            $rachas++;

            # code...
            if (($j === $length - 1) || ($secuenciaBits[$j + 1] === $descontinuador)) {

                // if (($j !== $length - 1) && ($secuenciaBits[$j + 1] === $descontinuador)) {
                # code...
                $aux = $j;
                break;
            }
        }

        $datos = ['rachas' => $rachas, 'actualValor' => $aux];
        // dd($datos);
        return $datos;
    }

    public function contadorLongitudRachas($secuenciaBits, $evaluador, $descontinuador)
    {
        // dump("dentro del contador Longitud");    
        // dump($secuenciaBits);

        // return $descontinuador;
        $rachasUnos = [
            'log1' => 0,
            'log2' => 0,
            'log3' => 0,
            'log4' => 0,
            'log5' => 0,
            'log6' => 0,
        ];
        //secuencia de 1 
        $length  = count($secuenciaBits);
        for ($i = 0; $i < $length; $i++) {
            # code...
            // if($i==$length){
            //     break;
            // }
            $rachas = $this->contadorRachas($secuenciaBits, $evaluador, $descontinuador, $i); //funciona correctamente
            // dump($rachas);
            if ($rachas['rachas'] == 1) {
                # code...
                $rachasUnos['log1']++;
            } elseif ($rachas['rachas'] == 2) {
                # code...
                $rachasUnos['log2']++;
            } elseif ($rachas['rachas'] == 3) {
                # code...
                $rachasUnos['log3']++;
            } elseif ($rachas['rachas'] == 4) {
                # code...
                $rachasUnos['log4']++;
            } elseif ($rachas['rachas'] == 5) {
                # code...
                $rachasUnos['log5']++;
            } elseif ($rachas['rachas'] >= 6) {
                # code...
                $rachasUnos['log6']++;
            }
            // return $rachas;
            if ($rachas['actualValor'] == 0) {
                break;
            }
            $i = $rachas['actualValor'];

            // dd($rachas);
        }
        // return $secuenciaBits;
        // dd($rachasUnos);
        return $rachasUnos;
    }
    public function evaluacionRachas($rangosEvaluacionRachas, $longitudRachas)
    {
        $evaluacionRachas = [];
        foreach ($longitudRachas as $key => $longitud) {
            # code...
            $log1 = ($longitud >= $rangosEvaluacionRachas[$key][0] && $longitud <= $rangosEvaluacionRachas[$key][1]) ? 1 : 0;
            $log2 = ($longitud >= $rangosEvaluacionRachas[$key][0] && $longitud <= $rangosEvaluacionRachas[$key][1]) ? 1 : 0;
            $log3 = ($longitud >= $rangosEvaluacionRachas[$key][0] && $longitud <= $rangosEvaluacionRachas[$key][1]) ? 1 : 0;
            $log4 = ($longitud >= $rangosEvaluacionRachas[$key][0] && $longitud <= $rangosEvaluacionRachas[$key][1]) ? 1 : 0;
            $log5 = ($longitud >= $rangosEvaluacionRachas[$key][0] && $longitud <= $rangosEvaluacionRachas[$key][1]) ? 1 : 0;
            $log6 = ($longitud >= $rangosEvaluacionRachas[$key][0] && $longitud <= $rangosEvaluacionRachas[$key][1]) ? 1 : 0;
            $evaluacionRachas = [$log1, $log2, $log3, $log4, $log5, $log6];
        }
        return $evaluacionRachas;
    }

    function cambiarClavesPorIndices($array)
    {
        $resultado = [];
        // $indice = 0;

        // Iteramos sobre cada elemento del array
        foreach ($array as $clave => $valor) {
            // Asignamos un índice entero como nueva clave
            $resultado[] = $valor;
            // $indice++;
        }

        return $resultado;
    }
    public function testTachas($n)
    {
        // return $n;
        // recuperar n ultimos valores generados por x generacion aleatoria
        $fibonacci = Fibonacci::orderBy('created_at', 'desc')->take($n)->get();
        //generacion de la secuencia fibonacci
        // dd(count($fibonacci));
        $secuenciaFibonacci = $this->agrupacionNumerosAleatorios($fibonacci);
        // dd($secuenciaFibonacci);
        //generar secuencia de bits apartir de la secuenciaFibonacci

        $secuenciaBits = $this->generacionSecuenciaBits($secuenciaFibonacci);
        // dd($secuenciaBits);

        //conteo de rachas

        $longitudRachasUnos = $this->contadorLongitudRachas($secuenciaBits, 1, 0); //joya
        $longitudRachasCeros = $this->contadorLongitudRachas($secuenciaBits, 0, 1); //joya
        // redd($longitudRachasCeros);
        // dd($longitudRachasUnos, $longitudRachasCeros);
        // evaluar rachas
        //la evaluacion dice si pasa o no las rachas de unos y ceros. Almacena un booleano 
        //[1=>0] logitud 1 cumple ? 0 falso 
        // dump($longitudRachasUnos);
        // dump($longitudRachasCeros);

        //   dd($longitudRachasUnos);
        $rangosEvaluacionRachas = ['log1' => [2343, 2657], 'log2' => [1135, 1365], 'log3' => [542, 708], 'log4' => [251, 373], 'log5' => [111, 201], 'log6' => [111, 201]];

        $evaulacionRachasUnos = $this->evaluacionRachas($rangosEvaluacionRachas, $longitudRachasUnos);
        $evaulacionRachasCeros = $this->evaluacionRachas($rangosEvaluacionRachas, $longitudRachasCeros);
        // dd($evaulacionRachasUnos, $evaulacionRachasCeros);
        $longitudRachasUnos = $this->cambiarClavesPorIndices($longitudRachasUnos);
        $longitudRachasCeros = $this->cambiarClavesPorIndices($longitudRachasCeros);
        $rangosEvaluacionRachas = $this->cambiarClavesPorIndices($rangosEvaluacionRachas);
        return view('TestRachas.resultado', compact('evaulacionRachasUnos', 'evaulacionRachasCeros', 'longitudRachasUnos', 'longitudRachasCeros', 'secuenciaFibonacci','rangosEvaluacionRachas'));
    }

}
