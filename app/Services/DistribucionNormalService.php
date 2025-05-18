<?php

namespace App\Services;

use App\Services\StatisticsService;

class DistribucionNormalService
{


    public function __construct(protected StatisticsService $stats) {}
    public function generarDistribucion(float $media, float $desviacion, array $valoresX, int $cantidad = 1000, int $clases = 9)
    {
      
        // verificar el paso entre cada marca x
        $paso =  2;
        
        // ---------------
        $tabla = [];
        $acumulada = 0;
        $clase= 1;
        foreach ($valoresX as $key => $x) {
            //calculo los limites inferior y superior de marcas x 
            $limInf = $x - ($paso / 2);
            $limSup = $x + ($paso / 2);

            // calcular los intervalos de clase z 
            $liZ = $this->zcore($limInf, $media, $desviacion);
            $lsZ = $this->zcore($limSup, $media, $desviacion);
            // obtener el valores representativos de cada clase z 
            $marcaZ =  ($lsZ + $liZ) / 2;
            // calcular las probabiliddades de cada clase z
            $probZ = $this->densidadProbabilidad($liZ, $lsZ);
            // calcular la probabilidad acumulada
            $acumulada += $probZ;
            $tabla[] = [
                'clase' => $clase++,
                'valorX' => round($x, 4),
                'limInf' => round($limInf, 4),
                'limSup' => round($limSup, 4),
                'liZ' => round($liZ, 4),
                'lsZ' => round($lsZ, 4),
                'marcaZ' => round($marcaZ, 4),
                'probZ' => round($probZ, 4),
                'acumulada' => round($acumulada, 4),
            ];
        }
        return $tabla;

    }

    private function boxMuller(): float
    {
        // Método Box-Muller para generar N(0,1)
        $u1 = mt_rand() / mt_getrandmax();
        $u2 = mt_rand() / mt_getrandmax();
        return sqrt(-2 * log($u1)) * cos(2 * pi() * $u2);
    }

    // calculo del valor de x real mediante la media y la desviacion
    private function calcXReal($media, $desviacion, $signo, $z)
    {
        if ($signo == '-') {
            return $media - $desviacion * $z;
        }
        if ($signo == '+') {
            return $media + $desviacion * $z;
        }

        // return  $desviacion + $media;
    }

   
 

    // calculo de z apartir de x
    public function zcore($x, $media = 0, $desv = 1)
    {
        return ($x - $media) / $desv;
    }
    // calculo de x a partir de z
    public function xcore($z, $media, $desv)
    {
        return $z * $desv + $media;
    }
    public function densidadProbabilidad($limInf, $limSup, $media = 0, $desv = 1)
    {
        // Calcular la probabilidad de densidad

        $probInf = $this->stats->normalCdf($limInf, $media, $desv);
        $probSup = $this->stats->normalCdf($limSup, $media, $desv);
        return $probSup - $probInf;
    }

    public function inversaZ($p,$m,$d){
        return $this->stats->invNormal($p,$m,$d);
    }
}
