<?php

namespace App\Services;

class MonteCarloService
{
    private DistribucionNormalService $distribucionNormalService;

    public function __construct(DistribucionNormalService $distribucionNormalService)
    {
        $this->distribucionNormalService = $distribucionNormalService;
    }

    public function generadorMarcasClases(
        $media = 170,
        $desviacionEstandar = 10,
        $numeroMarcasClases = 4,
        $porcentajeValoresExtremos = 0.95
    ) {
        // media 
        // desviacion estandar
        // numero de marcas de clases 
        // porcentaje de valores extremos

        // validar que la media y la desviacion estandar sean mayores a 0
        if ($media <= 0 || $desviacionEstandar <= 0) {
            return response()->json(['error' => 'La media y la desviacion estandar deben ser mayores a 0'], 400);
        }
        // validar que el numero de marcas de clases sea mayor a 0
        if ($numeroMarcasClases <= 0) {
            return response()->json(['error' => 'El numero de marcas de clases debe ser mayor a 0'], 400);
        }

        //valores extremos 
        $valoresExtremos = $this->obtenerValoresExtremos($porcentajeValoresExtremos, $media, $desviacionEstandar);
// return $valoresExtremos;
        // calcular el rango
        // OJO
        $rango = $valoresExtremos['superior'] - $valoresExtremos['inferior'];
        // return $rango;
        // calcular el ancho de la marca de clase
        $anchoMarcaClase = round($rango / $numeroMarcasClases, 2);
        // return $anchoMarcaClase;
        // calcular las marcas de clase
        $marcasClases = $this->calcularMarcasClases($valoresExtremos, $anchoMarcaClase, $numeroMarcasClases);
        return [
            'valoresExtremos' => $valoresExtremos,
            'rango' => $rango,
            'anchoMarcaClase' => $anchoMarcaClase,
            'marcasClases' => $marcasClases
        ];
    }

    private function calcularMarcasClases($valoresExtremos, $anchoMarcaClase, $numeroMarcasClases)
    {
        // dump($valoresExtremos,$anchoMarcaClase,$numeroMarcasClases);
        // calcular el limite inferior de la primera marca de clase
        $limiteInferior = $valoresExtremos['inferior'] ;
        // calcular el limite superior de la primera marca de clase
        $limiteSuperior = $valoresExtremos['inferior'] + ($anchoMarcaClase );
        // dump($limiteInferior, $limiteSuperior);
        $marcasClases = [];
        for ($i = 0; $i < $numeroMarcasClases; $i++) {
            $marcasClases[] = [
                'numero_marca_clase' => $i + 1,
                'limite_inferior' => round($limiteInferior, 2),
                'limite_superior' => round($limiteSuperior, 2),
                'marca_clase' => round(($limiteInferior + $limiteSuperior) / 2, 2)
            ];
            // actualizar los limites para la siguiente marca de clase
            $limiteInferior = $limiteSuperior;
            $limiteSuperior += $anchoMarcaClase;
        }
        return $marcasClases;
    }
    private function obtenerValoresExtremos($porcentajeValoresExtremos, $media, $desviacionEstandar)
    {

        switch ($porcentajeValoresExtremos) {
            case 0.68:
                # code...
                $valoresExtremos = [
                    'inferior' => $media - $desviacionEstandar,
                    'superior' => $media + $desviacionEstandar
                ];
                break;
            case 0.95:
                # code...
                $valoresExtremos = [
                    'inferior' => $media - (2 * $desviacionEstandar),
                    'superior' => $media + (2 * $desviacionEstandar)
                ];
                break;
            case 0.997:
                # code...
                $valoresExtremos = [
                    'inferior' => $media - (3 * $desviacionEstandar),
                    'superior' => $media + (3 * $desviacionEstandar)
                ];
                break;

            default:
                # code...
                break;
        }
        return $valoresExtremos;
    }
    public function generateRandomNumbers($n, $v1, $v2, $m)
    {
        $numeros = [];
        for ($i = 0; $i < $n; $i++) {
            $v3 = ($v1 + $v2) % $m;
            $numeros[] = $v3;
            $v1 = $v2;
            $v2 = $v3;
        }
        return $numeros;
    }

    private function numerosGeneradosIntervalos($numeros = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10], $intervalo = [5, 9])
    {

        $numeros = array_map(function ($numero) use ($intervalo) {
            return $intervalo[0] + ($numero / 10) * ($intervalo[1] - $intervalo[0]);
        }, $numeros);

        return $numeros;
    }
    private function transformarNumeroIntervalo($numero, $intervalo = [0, 1])
    {
        $numero = $this->normalizar($numero);
        return $intervalo[0] + ($numero) * ($intervalo[1] - $intervalo[0]);
    }
   private function normalizar($numero) {
        $digitos = strlen((string)$numero);
        $divisor = pow(10, $digitos);
        return $numero / $divisor;
    }
    public function conversionNumerosZ($numeros = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10], $media = 170, $desviacionEstandar = 10)
    {

        // obtener el valor de Z asociado a la probabilidad

        // dd($numeros[0]['resultado']);
        $conversion  = [];
        foreach ($numeros as   $numero) {
            $numero = $this->transformarNumeroIntervalo($numero['resultado']);
            $z = $this->distribucionNormalService->inversaZ($numero, $media, $desviacionEstandar);
            $conversion[] = [
                'numero' => $numero,
                'z' => round($z, 0),
            ];
        }
         
        return $conversion;
    }


    public function clasificarNumeros(
        $numeros = [
            169.48,
            175.49,
            163.65,
            175.84,
            175.91,
            161.33,
            161.24,
            174.82,
            191.32,
            177.19,
            172.32,
            182.30,
            183.60,
            160.45,
            161.27,
            166.63,
            167.50,
            183.25,
            171.48,
            170.45,
            160.03,
            177.77,
            164.92,
            170.80,
            172.94,
            175.62,
            161.29,
            151.86,
            176.98,
            159.00,
            174.88,
            169.35,
            176.63,
            181.57,
            170.21,
            160.88,
            178.36,
            164.83,
            163.94,
            152.32,
            172.44,
            191.56,
            192.61,
            169.92,
            175.75,
            174.38,
            174.68,
            173.24,
            152.51,
            181.86,
            157.42,
            163.36,
            180.24,
            153.42,
            164.94,
            163.61,
            174.63,
            148.80,
            160.39,
            180.77,
            168.69,
            182.96,
            171.60,
            167.44,
            176.93,
            171.01,
            172.98,
            158.32,
            182.08,
            161.54,
            161.74,
            165.48,
            155.40,
            162.60,
            183.12,
            174.94,
            166.27,
            166.73,
            182.14,
            179.35,
            160.01,
            158.17,
            171.28,
            155.29,
            163.37,
            172.25,
            171.80,
            171.15,
            169.26,
            176.46,
            176.54,
            160.16,
            148.94,
            166.26,
            189.08,
            181.38,
            173.42,
            160.91,
            149.17,
            178.39,
            172.87,
            175.11,
            169.45,
            177.06,
            181.56,
            161.89,
            165.03,
            180.34,
            168.33,
            177.24,
            172.37,
            152.59,
            167.05,
            186.19,
            166.50,
            169.22,
            168.47,
            146.20,
            162.76,
            174.76,
            179.39,
            175.95,
            180.83,
            152.38,
            168.35,
            175.79,
            167.83,
            191.11,
            165.60,
            162.00,
            188.84,
            176.19,
            168.56,
            164.46,
            165.76,
            169.24,
            158.91,
            171.99,
            167.10,
            165.34,
            168.77,
            165.08,
            171.70,
            167.71,
            160.54,
            179.82,
            161.63,
            183.52,
            175.93,
            190.64,
            165.09,
            176.12,
            189.28,
            169.35,
            168.63,
            161.46,
            157.77,
            174.13,
            176.04,
            162.73,
            171.23,
            171.96,
            155.22,
            163.38,
            186.77,
            162.95,
            172.33,
            163.10,
            147.58,
            183.70,
            165.56,
            178.59,
            166.78,
            144.65,
            171.03,
            170.02,
            160.76,
            158.10,
            171.94,
            165.73,
            171.83,
            160.32,
            184.30,
            157.88,
            165.09,
            174.17,
            160.47,
            174.44,
            176.87,
            166.21,
            156.65,
            179.21,
            181.03,
            183.05,
            183.30,
            171.53,
            178.32,
            165.56,
            169.88,
            178.04,
            159.26,
            170.47,
            174.67,
            157.73,
            166.20,
            168.10,
            166.89,
            181.22,
            176.08,
            172.84,
            174.75,
            164.40
        ],
        $marcas = [
            ['numero_marca_clase' => 1, 'limite_inferior' => 150, 'limite_superior' => 160],
            ['numero_marca_clase' => 2, 'limite_inferior' => 160, 'limite_superior' => 170],
            ['numero_marca_clase' => 3, 'limite_inferior' => 170, 'limite_superior' => 180],
            ['numero_marca_clase' => 4, 'limite_inferior' => 180, 'limite_superior' => 190],
        ]
    ) {

        // en base a las marcas de clases y las muestras artificales 
        // contar cuales caen dentro de cada marca. 

    // dump($numeros, $marcas);
        $conteo = [];
        foreach ($marcas as $marca) {
            $conteo[] = [
                'marca' => $marca['numero_marca_clase'],
                'cantidad' => count(array_filter($numeros, function ($numero) use ($marca) {
                    return $numero['z'] >= $marca['limite_inferior'] && $numero['z'] < $marca['limite_superior'];
                })),
            ];
        }
        return $conteo;
    }
}
