<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MultinomialResult;
use App\Models\MultinomialCategory;
use Illuminate\Support\Facades\DB;

class DistribucionController extends Controller
{
    // Vista principal de distribuciones
    public function index()
    {
        return view('Distribuciones.index');
    }

    // Vista específica para Multinomial (formulario)
    public function multinomialIndex()
    {
        return view('Distribuciones.Multinomial.index');
    }

    // Calcular distribución multinomial
    public function calcularMultinomial(Request $request)
    {
        // Validar datos de entrada
        $request->validate([
            'ensayos' => 'required|integer|min:1',
            'categorias' => 'required|array|min:2',
            'probabilidades' => 'required|array|min:2',
            'probabilidades.*' => 'numeric|min:0.01|max:0.99',
        ]);

        // Normalizar probabilidades (suma = 1)
        $probabilidades = $request->probabilidades;
        $suma = array_sum($probabilidades);
        $probabilidades = array_map(function ($p) use ($suma) {
            return $p / $suma;
        }, $probabilidades);

        // Generar muestra artificial
        $resultados = $this->generarMultinomial($request->ensayos, $probabilidades);

        // Guardar en BD con transacción
        DB::transaction(function () use ($request, $probabilidades, $resultados) {
            $resultado = MultinomialResult::create(['ensayos' => $request->ensayos]);

            foreach ($request->categorias as $index => $nombreCategoria) {
                $categoria = MultinomialCategory::firstOrCreate(['name' => $nombreCategoria]);

                $resultado->categories()->attach($categoria->id, [
                    'count' => $resultados[$index],
                    'theoretical_probability' => $probabilidades[$index]
                ]);
            }
        });

        // Pasar los nombres de categorías a la vista
        return view('distribuciones.multinomial.resultado', [
            'categorias' => $request->categorias,
            'probabilidades' => $probabilidades,
            'resultados' => $resultados
        ]);
    }

    private function generarMultinomial($n, $probabilidades)
    {
        $muestra = array_fill(0, count($probabilidades), 0);

        for ($i = 0; $i < $n; $i++) {
            $u = mt_rand() / mt_getrandmax();
            $acumulado = 0;

            foreach ($probabilidades as $j => $p) {
                $acumulado += $p;
                if ($u <= $acumulado) {
                    $muestra[$j]++;
                    break;
                }
            }
        }

        return $muestra;
    }
}
