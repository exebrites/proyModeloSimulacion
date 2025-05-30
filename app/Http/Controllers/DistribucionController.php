<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MultinomialResult;
use App\Models\MultinomialCategory;
use Illuminate\Support\Facades\DB;
use App\Services\StatisticsService;
use App\Services\DistribucionNormalService;
use InvalidArgumentException;

class DistribucionController extends Controller
{
    protected StatisticsService $stats;
    protected DistribucionNormalService $service;


    public function __construct(StatisticsService $stats, DistribucionNormalService $service)
    {
        $this->service = $service;
        $this->stats = $stats;
    }



    // Vista principal de distribuciones
    public function index()
    {
        return view('Distribuciones.index');
    }

    /*
    
    PARTE DE LA DISTRIBUCION MULTINOMIAL
    Esta parte del controlador maneja la distribucion multinomial, mostrando el formulario
    y procesando los datos enviados por el usuario.
    
    */

    // Vista específica para Multinomial (formulario)
    public function multinomialIndex()
    {


        return view('Distribuciones.Multinomial.index');
    }

    public function calcularMultinomial(Request $request)
    {
        // Validación
        $request->validate([
            'ensayos' => 'required|integer|min:1',
            'categorias' => 'required|array|min:2',
            'probabilidades' => 'required|array|min:2',
            'probabilidades.*' => 'numeric|min:0.01|max:0.99',
            'frecuencias' => 'required|array|min:2',
            'frecuencias.*' => 'integer|min:0' // Asegura que sean enteros
        ]);

        // Convertir frecuencias a enteros (doble validación)
        $frecuencias = array_map('intval', $request->frecuencias);
        // Normalizar probabilidades
        $probabilidades = $request->probabilidades;
        $suma = array_sum($probabilidades);
        $probabilidades = array_map(fn($p) => $p / $suma, $probabilidades);

        // Validar que la suma de frecuencias coincida con el número de ensayos
        if (array_sum($request->frecuencias) != $request->ensayos) {
            return back()->withErrors([
                'frecuencias' => 'La suma de las frecuencias debe ser igual al número de ensayos'
            ])->withInput();
        }

        try {
            // Usar las frecuencias ingresadas por el usuario
            $resultados = $request->frecuencias;

            // Calcular probabilidad exacta para los resultados ingresados
            $probabilidadExacta = $this->stats->multinomialPmf(
                $probabilidades,
                $request->ensayos,
                $resultados
            );

            return view('Distribuciones.Multinomial.resultado', [
                'categorias' => $request->categorias,
                'probabilidades' => $probabilidades,
                'resultados' => $resultados,
                'probabilidadExacta' => $probabilidadExacta,
                'ensayos' => $request->ensayos
            ]);
        } catch (InvalidArgumentException $e) {
            return back()->withErrors([
                'error' => $e->getMessage()
            ])->withInput();
        }
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

    private function calcularProbabilidadMultinomial($n, $probabilidades, $conteos)
    {
        // Calcular el coeficiente multinomial: n! / (x1! * x2! * ... * xk!)
        $coeficiente = $this->stats->factorial($n);
        foreach ($conteos as $x) {
            $coeficiente /= $this->stats->factorial($x);
        }

        // Calcular el producto de las probabilidades elevadas a los conteos
        $productoProbabilidades = 1;
        foreach ($probabilidades as $i => $p) {
            $productoProbabilidades *= pow($p, $conteos[$i]);
        }

        return $coeficiente * $productoProbabilidades;
    }

    /*
    
    PARTE DE LA DISTRIBUCION NORMAL
    Esta parte del controlador maneja la distribucion normal, mostrando el formulario

    */

    // GET /distribucion-normal: muestra el formulario.
    public function normalIndex()
    {
        return view('Distribuciones.Normal.index');
        return "index normal";
    }
    // POST /distribucion-normal: procesa los datos y devuelve los resultados.
    public function calcularNormal(Request $request)
    {
        // Obtiene los valores de los campos dinamicos enviados por el formulario
        $datos = $request->input('number', []);

        // Obtiene la media y la desviacion estandar del formulario
        $media = $request->input('media');
        $desviacionEstandar = $request->input('desviacion_estandar');

        // Llama a la funcion generarDistribucion del servicio para generar la tabla de distribucion normal
        $tabla = $this->service->generarDistribucion($media, $desviacionEstandar, $datos, 1000, 9);
        // return $tabla;
        // Muestra la vista resultado.blade.php con la tabla generada
        return view('Distribuciones.Normal.resultado', compact('tabla'));
    }
}
