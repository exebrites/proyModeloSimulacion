<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Congruencia;
use App\Models\CongruenciaMixto;
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

        return "congruencia";
        /*
        Se basan en Relación Fundamental de Congruencias:
            V i+1 =(a V i + c V i-k) mod m
        

            donde Vi , Vi-k , a , c , k , m son enteros no negativos y  arbitrarios 

            que cumplen las sig. condiciones: Vi <> 0, a <> 0, c <> 0, m > Vi , m > a, m > 0.    

        */


        /*
        por el momento m será un valor que se ingresa -> en el segundo hito si es necesario se agrega lo sig. 

            La mayor parte de las versiones para computadora de este
        método emplean un módulo m=pe, donde
        

        */

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


        // 1. DECLARAR VARIABLES
        // valores de entrada
        $a = $datosValidados['a']; //$request->input('a');
        $c = $datosValidados['c']; //$request->input('c');
        $m = $datosValidados['m']; //$request->input('m');
        $v0  = $datosValidados['v0']; //$request->input('v0'); Semilla
        $n = $datosValidados['n']; //$request->input('i'); Iteraciones
        $v1 = $datosValidados['v1']; //$request->input('v1');
        $sucesores = [$v0, $v1];
        // valores del bucle
        // 2. VERIFICAR CONDICIONES

        // 3. DEFINIR V i+1 =(a V i + c V i-k) mod m
        // $v2 = ($a*$v1+$c*$v0)%$m;
        // 4. REALIZAR LOOP Y ALMACENAR RESULTADO
        for ($i = 0; $i < $n; $i++) {
            # code...
            $v2 = ($a * $v1 + $c * $v0) % $m;
            $v0 = $v1;
            $v1 = $v2;
            $sucesores[] = $v2;
        }
        foreach ($sucesores as  $valor) {
            # code...
            Congruencia::create([
                'valor' => $valor
            ]);
        }
        return "resultado congruencia";
    }

    public function metodoCongruenciaMixto(Request $request)
    {

      
        // // VALIDACIONES
        $datosValidados = $request->validate([
            'a' => 'required|numeric|min:1',
            'c' => 'required|numeric|min:1',
            'm' => 'required|numeric|min:1',
            // 'v0' => 'required|numeric|min:1',
            'v1' => 'required|numeric|min:1',
            'n' => 'required|numeric|min:1',
        ]);

        if ($datosValidados['m'] < $datosValidados['a']) {
            // return redirect()->back()->with('error', 'El modulo debe ser mayor a la semilla y a');
            return 'El modulo debe ser mayor a la semilla y a';
        }


        // 1. DECLARAR VARIABLES
        // valores de entrada
        $a = $datosValidados['a']; //$request->input('a');
        $c = intval($datosValidados['c']); //$request->input('c');
        $m = $datosValidados['m']; //$request->input('m');
        // $v0  = $datosValidados['v0']; //$request->input('v0'); Semilla
        $n = $datosValidados['n']; //$request->input('i'); Iteraciones
        $v1 = intval($datosValidados['v1']); //$request->input('v1');
        // $sucesores = [$v0, $v1];



        $v0  = 1; //$request->input('v0'); Semilla

        $sucesores = [$v0, $v1];


        //validadciones
        // El valor de a debe ser entero impar, y no debe ser divisible
        // por 3 ó 5.
        if (($a % 2) == 0) {
            // return redirect()->back()->with('error', 'a deber ser impar');
            return 'a deber ser impar';
        }
        if (($a / 3) == 0) {
            // return redirect()->back()->with('error', 'a no debe ser divisible por 3');
            return 'a no debe ser divisible por 3';
        }
        if (($a / 5) == 0) {
            // return redirect()->back()->with('error', 'a no debe ser divisible por 5');
            return 'a no debe ser divisible por 5';
        }

        //validaciones para c 
        // dd($c);
        // El valor de c debe ser entero impar y relativamente primo a m.
        if (($c % 2) == 0) {
            # code...
            // return redirect()->back()->with('error', 'c deber ser impar');
            return 'c deber ser impar';
        }
        if (!$this->sonCoprimos($c, $m)) {
            // return redirect()->back()->with('error', 'c debe ser coprimo de m');
            return 'c debe ser coprimo de m';
        }
        //metodo 
        for ($i = 1; $i < $n; $i++) {
            # code...
            $v2 = ($a * $v1 + $c * $v0) % $m;
            // $v0 = $v1;
            $v1 = $v2;
            $sucesores[] = $v2;
        }

        //registro y retorno


        foreach ($sucesores as  $valor) {
            # code...
            CongruenciaMixto::create([
                'valor' => $valor
            ]);
        }
        return view('CongruenciaMixto.resultado',compact('sucesores'));
    }
}
