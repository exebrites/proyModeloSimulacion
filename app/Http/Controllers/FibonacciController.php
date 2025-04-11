<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FibonacciController extends Controller
{


    /*
        NÚMEROS PSEUDOALEATORIOS
        MÉTODO DE FIBONACCI
        Consiste en:
        1. Elegir 3 (tres) parámetros (enteros no negativos de 3 a 7
        dígitos): V1, V2 y A, que se asignan como valores del
        primer y segundo términos de la serie y de un parámetro de
        control, respectivamente.

        
        2. Aplicar: V3 = V2 + V1 + k A, donde k es un parámetro real y
        entero que se define como:
        * 0 si V2 + V1 <= A
        * -1 en otro caso
        3. Asignar V3 a V2, y V2 a V1.
        4. Repetir los pasos del 2 al 3 n veces, siendo n la cantidad de
        nros pseudoaleatorios a generar.
    */


    public function metodoFibonacci(Request $request)
    {
        $v1 = $request->input('v1');
        $v2 = $request->input('v2');
        $a = $request->input('a');
        $n = $request->input('n');
        //comienzo del bucle


        // repetir n veces

        for ($i = 0; $i < $n; $i++) {
            # code...

            // definir k 
            /*
        SI V2 + V1 <= A   ENTONCES k = 0
        SINO k = -1
        */
            $k = 0;
            $aux = $v1 + $v2;
            if ($aux <= $a) {
                # code...
                $k = 0;
            } else {
                # code...
                $k = -1;
            }
            // V3 = V2 + V1 + k A
            $v3 = $v2 + $v1 + $k * $a;

            //asignar valores
            //v2=v3
            //v1=v2
            $v2 = $v3;
            $v1 = $v2;

            // almacenar v3 en db
        }
    }
}
