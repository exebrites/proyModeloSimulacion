<?php

namespace App\Http\Controllers;

use App\Models\Fibonacci;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Semilla;
use App\Models\Numeros;

class FibonacciController extends Controller
{


    public function index()
    {
        $semillas = Semilla::where('metodo', 'fibonacci')->get();
        // Obtener los números generados para cada semilla


        return view('Fibonacci.index', compact('semillas'));
    }

    public function fibonacci()
    {
        return view('Fibonacci.create');
    }

    public function show($id)
    {
        $semilla = Semilla::findOrFail($id);
        $numeros = Numeros::where('semilla_id', $id)->get();

        return view('Fibonacci.show', compact('semilla', 'numeros'));
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
                'max:20000',
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


    public function metodoFibonacciExtendido(Request $request)
    {



        $existeSemilla = Semilla::where('v1', $request->input('v1'))
            ->where('v2', $request->input('v2'))
            ->where('m', $request->input('a'))
            ->first();
        if ($existeSemilla) {
            // return redirect()->back()->with('error', 'La semilla ingresada ya existe en la base de datos');
            // return "La semilla ingresada ya existe en la base de datos";
            return redirect()->route('fibonacci')
                ->with('error', 'La semilla ingresada ya existe en la base de datos');

            // redirigir a la vista index fibonacci listando los numeros generados
        }

        // Crear semilla
        $semilla = new Semilla();
        $semilla->v1 = (int) $request->input('v1');
        $semilla->v2 = (int)$request->input('v2');
        $semilla->m = $request->input('a');
        $semilla->metodo = 'fibonacci';
        // return response()->json($semilla);
        $semilla->save();

        $n = $request->input('n');

        // dd($semilla);
        // Generar números
        $numeros[1] = ['resultado' => $semilla->v1, 'semilla_id' => $semilla->id];
        $numeros[2] = ['resultado' => $semilla->v2, 'semilla_id' => $semilla->id];
        $k = null;
        for ($i = 3; $i <= $n; $i++) {
            $v3 = $semilla->v2 + $semilla->v1 + ($semilla->m * $k);
            $k = ($v3 <= $semilla->m) ? 0 : -1;
            $numeros[$i] = ['resultado' => $v3, 'semilla_id' => $semilla->id];
        }
        // return $numeros;
        // dd($numeros);
        // Guardar números
        Numeros::insert($numeros);
        // dd("hola");
        // Obtener números generados
        $lastFiveValues = Numeros::where('semilla_id', $semilla->id)->get();
        // return $numerosGenerados;
        // Devolver respuesta
        // return response()->json($numerosGenerados);
        return view('Fibonacci.resultado', [
            'lastFiveValues' => $lastFiveValues,
            'success' => 'Secuencia generada exitosamente!',
            'v1' => $semilla->v1,
            'v2' => $semilla->v2,
            'a' => $semilla->m,
            'n' => $n,
            'semilla_id' => $semilla->id,
            // 'numeros' => $numeros,
            // 'semilla' => $semilla,
        ]);
    }
}
