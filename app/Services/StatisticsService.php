<?php

namespace App\Services;

use MathPHP\Probability\Distribution\Continuous\Normal;
use MathPHP\Probability\Distribution\Multivariate\Multinomial;
use MathPHP\Statistics\Average;
use \InvalidArgumentException;

class StatisticsService
{
    public function normalCdf(float $value, float $mean = 0, float $stdDev = 1): float
    {
        $normal = new Normal($mean, $stdDev);
        return $normal->cdf($value);
    }

    // Podés agregar más métodos aquí según lo necesites
    public function invNormal($probabilidad, $media = 170, $desviacion = 10)
    {

        $normal =  new Normal($media, $desviacion);
        $z = $normal->inverse($probabilidad);


        return $z;
    }

    // Parte de la distribución multinomial
    /**
     * Calcula la probabilidad exacta usando la distribución multinomial
     */
    public function multinomialPmf(array $probabilities, int $trials, array $outcomes): float
    {
        // Convertir frecuencias a enteros
        $outcomes = array_map('intval', $outcomes);

        $this->validateMultinomialParams($probabilities, $trials, $outcomes);

        $dist = new Multinomial($probabilities, $trials);
        return $dist->pmf($outcomes);
    }
    /**
     * Genera una muestra aleatoria de una distribución multinomial
     */
    public function generateMultinomialSample(int $trials, array $probabilities): array
    {
        $this->validateProbabilities($probabilities);

        $categories = count($probabilities);
        $results = array_fill(0, $categories, 0);

        for ($i = 0; $i < $trials; $i++) {
            $r = mt_rand() / mt_getrandmax();
            $cumulative = 0;

            for ($j = 0; $j < $categories; $j++) {
                $cumulative += $probabilities[$j];
                if ($r <= $cumulative) {
                    $results[$j]++;
                    break;
                }
            }
        }

        return $results;
    }

    /**
     * Factorial con memoización para mejor performance
     */
    private static $factorialCache = [1 => 1];
    public function factorial(int $n): int
    {
        if ($n < 0) {
            throw new InvalidArgumentException('El número debe ser no negativo.');
        }

        if (!isset(self::$factorialCache[$n])) {
            self::$factorialCache[$n] = $n * $this->factorial($n - 1);
        }

        return self::$factorialCache[$n];
    }

    /**
     * Validación de parámetros para la distribución multinomial
     */
    private function validateMultinomialParams(array $probabilities, int $trials, array $outcomes): void
    {
        $this->validateProbabilities($probabilities);

        if ($trials <= 0) {
            throw new InvalidArgumentException('El número de ensayos debe ser positivo');
        }

        if (count($probabilities) !== count($outcomes)) {
            throw new InvalidArgumentException('Probabilidades y resultados deben tener la misma cantidad de categorías');
        }

        // Validar que las frecuencias sean enteras
        foreach ($outcomes as $outcome) {
            if (!is_int($outcome)) {
                throw new InvalidArgumentException('Las frecuencias deben ser valores enteros');
            }
        }

        if (array_sum($outcomes) !== $trials) {
            throw new InvalidArgumentException('La suma de los resultados debe ser igual al número de ensayos');
        }
    }

    /**
     * Validación que las probabilidades sumen 1
     */
    private function validateProbabilities(array $probabilities): void
    {
        $sum = array_sum($probabilities);
        if (abs($sum - 1.0) > 0.0001) {
            throw new InvalidArgumentException("Las probabilidades deben sumar 1 (actual: $sum)");
        }

        foreach ($probabilities as $p) {
            if ($p < 0 || $p > 1) {
                throw new InvalidArgumentException('Cada probabilidad debe estar entre 0 y 1');
            }
        }
    }
}
