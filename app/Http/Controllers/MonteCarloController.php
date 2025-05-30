<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MonteCarloService;
use App\Models\Semilla;
class MonteCarloController extends Controller
{
    public function __construct(
        private MonteCarloService $monteCarloService
    ) {}
    public function index()
    {
        return view('Distribuciones.Normal.index_monte');
    }

    public function montecarlo(Request $request)
    {
        $media = (float) $request->input('media');
        $desviacionEstandar = (float) $request->input('desviacion_estandar');
        $numeroMarcasClases = (int) $request->input('numero_marcas_clases');
        $porcentajeValoresExtremos = (float) $request->input('porcentaje_valores_extremos');
        // dd($media, $desviacionEstandar, $numeroMarcasClases, $porcentajeValoresExtremos);

        //validar los datos de entrada
        $monte = $this->monteCarloService->generadorMarcasClases(
            $media,
            $desviacionEstandar,
            $numeroMarcasClases,
            $porcentajeValoresExtremos
        );
        $marcas = $monte['marcasClases'];
        $semilla = Semilla::where('metodo', 'fibonacci')->find(1);
        $numeros = $semilla->numeros;

        $numeros = $semilla->numeros;
        $muestra = $this->monteCarloService->conversionNumerosZ($numeros, $media, $desviacionEstandar);
        $clasificacion = $this->monteCarloService->clasificarNumeros($muestra, $marcas);
        
        // dd($clasificacion);
        
    return view('Distribuciones.Normal.resultado_monte', [
        'marcas' => $marcas,
        'muestras' => $muestra,
        'clasificacion' => $clasificacion,
        'media' => $media,
        'desviacionEstandar' => $desviacionEstandar,
        'numeroMarcasClases' => $numeroMarcasClases,
        'porcentajeValoresExtremos' => $porcentajeValoresExtremos,
        'valoresExtremos' => $monte['valoresExtremos'],
        'numeros' => $numeros,
       
         
    ]);

     
   
    }
}
