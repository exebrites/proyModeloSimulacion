<?php

namespace App\Http\Controllers;

use App\Models\Fibonacci;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class FibonacciController extends Controller
{


    public function index()
    {
        return view('Fibonacci.index');
    }
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
        $mensajes = [
            'required' => 'El campo :attribute es obligatorio.',
            'integer' => 'El campo :attribute debe ser un número entero.',
            'min' => 'El campo :attribute debe tener al menos :min.',
            'max' => 'El campo :attribute no debe exceder :max.',
            'v1.min' => 'V1 debe tener mínimo 3 dígitos (100).',
            'v2.min' => 'V2 debe tener mínimo 3 dígitos (100).',
            'a.min' => 'El parámetro A debe tener mínimo 3 dígitos (100).',
        ];
    
        $validator = Validator::make($request->all(), [
            'v1' => [
                'required',
                'integer',
                'min:100',       // mínimo 3 dígitos
                'max:9999999',   // máximo 7 dígitos
                function ($attribute, $value, $fail) {
                    if ($value < 0) {
                        $fail('El valor de V1 no puede ser negativo.');
                    }
                },
            ],
            'v2' => [
                'required',
                'integer',
                'min:100',
                'max:9999999',
                function ($attribute, $value, $fail) {
                    if ($value < 0) {
                        $fail('El valor de V2 no puede ser negativo.');
                    }
                },
            ],
            'a' => [
                'required',
                'integer',
                'min:100',
                'max:9999999',
                function ($attribute, $value, $fail) use ($request) {
                    if ($value < 0) {
                        $fail('El valor de A no puede ser negativo.');
                    }
                    if ($value <= max($request->v1, $request->v2)) {
                        $fail('El parámetro A debe ser mayor que el mayor entre V1 y V2.');
                    }
                },
            ],
            'n' => [
                'required',
                'integer',
                'min:1',
                'max:1000',
            ],
        ], $mensajes);

        // Verificar si la validación falla
        if ($validator->fails()) {
            return redirect()
                ->route('fibonacci')
                ->withErrors($validator)
                ->withInput();
        }

        // Obtener valores validados
        $v1 = $request->input('v1');
        $v2 = $request->input('v2');
        $a = $request->input('a');
        $n = $request->input('n');

        // Limpiar la tabla antes de generar nueva secuencia (opcional)
        Fibonacci::truncate();

        // Guardar los valores iniciales
        Fibonacci::create(['valor' => $v1]);
        Fibonacci::create(['valor' => $v2]);

        // Generar la secuencia
        for ($i = 0; $i < $n; $i++) {
            $aux = $v1 + $v2;
            $k = ($aux <= $a) ? 0 : -1;
            $v3 = $v2 + $v1 + ($k * $a);

            // Actualizar valores para siguiente iteración
            $v1 = $v2;
            $v2 = $v3;

            // Guardar el nuevo valor
            Fibonacci::create(['valor' => $v3]);
        }

        // Obtener los últimos valores generados (incluyendo semillas)
        $lastValues = Fibonacci::orderBy('id', 'desc')
            ->take($n + 2)
            ->pluck('valor')
            ->toArray();

        $lastValues = array_reverse($lastValues);

        return view('Fibonacci.resultado', [
            'v1' => $v1,
            'v2' => $v2,
            'a' => $a,
            'n' => $n,
            'lastFiveValues' => $lastValues,
            'success' => 'Secuencia generada exitosamente!'
        ]);
    }
}
