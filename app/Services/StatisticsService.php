<?php

namespace App\Services;

use MathPHP\Probability\Distribution\Continuous\Normal;
use MathPHP\Probability\Distribution\Multivariate\Multinomial;

class StatisticsService
{
    public function normalCdf(float $value, float $mean = 0, float $stdDev = 1): float
    {
        $normal = new Normal($mean, $stdDev);
        return $normal->cdf($value);
    }

    public function multinomialPmf(array $probabilities, int $trials, array $outcomes): float
    {
        $dist = new Multinomial($probabilities, $trials);
        return $dist->pmf($outcomes);
    }

    // Podés agregar más métodos aquí según lo necesites
}

