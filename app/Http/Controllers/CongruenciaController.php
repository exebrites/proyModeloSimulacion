<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Congruencia;
use App\Models\CongruenciaMixto;
use Illuminate\Support\Facades\DB;

class CongruenciaController extends Controller
{
    //
    function sonCoprimos($a, $b)
    {
        while ($b != 0) {
            $temp = $b;
            $b = $a % $b;
            $a = $temp;
        }
        return $a == 1;
    }

    public function index()
    {
        // return "index congruencia";
        return view('CongruenciaMixto.index');
    }

    public function metodoCongruencia(Request $request)
    {
        try {
            // VALIDACIONES
            $datosValidados = $request->validate([
                'a' => 'required|numeric|min:1',
                'c' => 'required|numeric|min:1',
                'm' => 'required|numeric|min:1',
                'v0' => 'required|numeric|min:1',
                'v1' => 'required|numeric|min:1',
                'n' => 'required|numeric|min:1',
            ]);

            if ($datosValidados['m'] < $datosValidados['v0'] || $datosValidados['m'] < $datosValidados['a']) {
                return redirect()->back()->with('error', 'El modulo debe ser mayor a la semilla y a');
            }

            // DECLARAR VARIABLES
            $a = $datosValidados['a'];
            $c = $datosValidados['c'];
            $m = $datosValidados['m'];
            $v0 = $datosValidados['v0'];
            $v1 = $datosValidados['v1'];
            $n = $datosValidados['n'];
            $sucesores = [$v0, $v1];

            // INICIAR TRANSACCIÓN
            DB::beginTransaction();
            try {
                // REALIZAR LOOP Y ALMACENAR RESULTADO
                for ($i = 0; $i < $n; $i++) {
                    $v2 = ($a * $v1 + $c * $v0) % $m;
                    $v0 = $v1;
                    $v1 = $v2;
                    $sucesores[] = $v2;
                }

                // REGISTRO EN BASE DE DATOS
                foreach ($sucesores as $valor) {
                    Congruencia::create([
                        'valor' => $valor
                    ]);
                }

                // CONFIRMAR TRANSACCIÓN
                DB::commit();
            } catch (\Exception $e) {
                // REVERTIR TRANSACCIÓN EN CASO DE ERROR
                DB::rollBack();
                throw $e;
            }

            // RETORNO
            return "resultado congruencia";
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ocurrió un error: ' . $e->getMessage()], 500);
        }
    }

    public function metodoCongruenciaMixto(Request $request)
    {
        try {
            // VALIDACIONES BÁSICAS (tipos y rangos)
            $request->validate([
                'a' => 'required|integer|min:1',
                'c' => 'required|integer|min:1',
                'm' => 'required|integer|min:2', // Mínimo 2 para que pueda ser mayor que a y v1
                'v1' => 'required|integer|min:1',
                'n' => 'required|integer|min:1|max:1000',
            ]);

            // Obtener valores validados
            $a = (int)$request->input('a');
            $c = (int)$request->input('c');
            $m = (int)$request->input('m');
            $v1 = (int)$request->input('v1');
            $n = (int)$request->input('n');

            // VALIDACIONES ESPECÍFICAS DEL MÉTODO MIXTO
            $errors = [];

            // 1. Validar que m sea mayor que a y v1
            if ($m <= $a) {
                $errors[] = 'El módulo (m) debe ser mayor que el parámetro a';
            }
            if ($m <= $v1) {
                $errors[] = 'El módulo (m) debe ser mayor que la semilla v1';
            }

            // 2. Validar que a sea impar y no divisible por 3 o 5
            if ($a % 2 == 0) {
                $errors[] = 'El parámetro a debe ser impar';
            }
            if ($a % 3 == 0) {
                $errors[] = 'El parámetro a no debe ser divisible por 3';
            }
            if ($a % 5 == 0) {
                $errors[] = 'El parámetro a no debe ser divisible por 5';
            }

            // 3. Validar que c sea impar
            if ($c % 2 == 0) {
                $errors[] = 'El parámetro c debe ser impar';
            }

            // 4. Validar que c y m sean coprimos (MCD = 1)
            if (!$this->sonCoprimos($c, $m)) {
                $errors[] = 'El parámetro c y el módulo m deben ser coprimos (MCD = 1)';
            }

            // 5. Validar que v1 < m (ya validado parcialmente arriba)
            if ($v1 >= $m) {
                $errors[] = 'La semilla v1 debe ser menor que el módulo m';
            }

            // Si hay errores, redirigir con los mensajes
            if (!empty($errors)) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['custom' => $errors]);
            }

            // DECLARAR VARIABLES
            $sucesores = [$v1];

            // METODO
            DB::beginTransaction();
            try {
                $vi = $v1;
                for ($i = 1; $i < $n; $i++) {
                    $vi = ($a * $vi + $c) % $m;
                    $sucesores[] = $vi;
                }

                // REGISTRO EN BASE DE DATOS
                foreach ($sucesores as $valor) {
                    CongruenciaMixto::create([
                        'valor' => $valor
                    ]);
                }

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }

            // RETORNO
            return view('CongruenciaMixto.resultado', compact('sucesores'));
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['custom' => ['Ocurrió un error: ' . $e->getMessage()]]);
        }
    }
}
