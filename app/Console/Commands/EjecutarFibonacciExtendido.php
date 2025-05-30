<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Fibonacci;
use App\Models\SemillaPrueba;
use App\Models\NumerosPrueba;

class EjecutarFibonacciExtendido extends Command
{
    protected $signature = 'fibonacci:extendido {v1} {v2} {a} {n}';
    protected $description = 'Genera números con el método Fibonacci extendido, los guarda y ejecuta la prueba de Chi Cuadrado.';

    public function handle()
    {
        $v1 = (int) $this->argument('v1');
        $v2 = (int) $this->argument('v2');
        $a = (int) $this->argument('a'); // 'a' es el módulo en tu lógica
        $n = (int) $this->argument('n'); // Cantidad de números a generar

        // --- 1. Verificación y Creación de Semilla ---
        $existe = SemillaPrueba::where('v1', $v1)
                         ->where('v2', $v2)
                         ->where('m', $a) // 'm' en la BD es tu 'a' aquí
                         ->first();

        if ($existe) {
            $this->error('La semilla ingresada ya existe en la base de datos.');
            return Command::FAILURE;
        }

        $semilla = SemillaPrueba::create([
            'v1' => $v1,
            'v2' => $v2,
            'm' => $a,
            'metodo' => 'fibonacci'
        ]);

        $numerosGenerados = []; // Aquí almacenaremos los números generados antes de guardar

        // Los dos primeros números de la secuencia
        $numerosGenerados[] = $v1;
        $numerosGenerados[] = $v2;

        $tempV1 = $v1;
        $tempV2 = $v2;

        // --- 2. Generación de Números Fibonacci Extendido ---
        // Asumo que el "Fibonacci Extendido" se refiere a la secuencia modular: X_i = (X_{i-1} + X_{i-2}) % M
        // Donde M es tu parámetro 'a'.
        // Si tu definición es diferente (ej. con el factor 'k' restando 'a'), ajusta la lógica aquí.

        for ($i = 3; $i <= $n; $i++) {
            $v3 = ($tempV1 + $tempV2) % $a;
            // Si $v3$ puede ser 0 y necesitas que no lo sea (ej. si el rango es de 1 a 'a'):
            // if ($v3 == 0) { $v3 = $a; }

            $numerosGenerados[] = $v3;
            $tempV1 = $tempV2;
            $tempV2 = $v3;
        }

        // --- 3. Guardar Números Generados en la Base de Datos ---
        $datosParaGuardar = [];
        foreach ($numerosGenerados as $num) {
            // Asegúrate de que el nombre de la columna es 'semilla_prueba_id'
            $datosParaGuardar[] = ['resultado' => $num, 'semilla_prueba_id' => $semilla->id];
        }
        NumerosPrueba::insert($datosParaGuardar);

        $this->info("--- Generación de Fibonacci Extendido ---");
        $this->info("Semilla guardada con ID: {$semilla->id}");
        $this->info("Parámetros: v1={$v1}, v2={$v2}, a={$a}, n={$n}");
        $this->info("Números generados (" . count($numerosGenerados) . " en total):");

        foreach ($numerosGenerados as $index => $item) {
            $this->line("[$index] → {$item}");
        }

        // --- 4. Ejecutar la Prueba de Chi Cuadrado como un método separado ---
        $this->runChiSquaredTest($numerosGenerados);

        return Command::SUCCESS;
    }
    // Método para ejecutar la Prueba de Chi Cuadrado
     private function runChiSquaredTest(array $numerosGenerados): void
    {
        $this->info("\n--- Iniciando Prueba de Chi Cuadrado ---");

        // Si los números son enteros grandes y necesitas trabajar con dígitos, adapta aquí.
        // Tu código de ChiController parece asumir que extrae dígitos de la concatenación de números.
        $secuenciaAgrupacion = "";
        foreach ($numerosGenerados as $num) {
            $secuenciaAgrupacion .= strval($num); // Concatena los números como cadenas
        }

        $n_chi = strlen($secuenciaAgrupacion); // Cantidad total de dígitos
        $k = 10; // total de números en el intervalo 0 a 9 (para dígitos)

        if ($n_chi == 0) {
            $this->error("No hay dígitos para realizar la prueba de Chi Cuadrado. La secuencia generada está vacía.");
            return; // No hay necesidad de continuar si no hay dígitos
        }

        // N / k (Frecuencia esperada)
        $npi = $n_chi / $k;
        // Grados de libertad (k-1)
        $gl = $k - 1;

        // Valor de Chi Cuadrado Crítico (para alfa=0.05 y gl=9)
        $chiCuadradoCritico = 16.919; // Para 9 grados de libertad y alfa=0.05 (confianza 95%)

        $frecuenciaObservada = array_fill(0, 10, 0); // Inicializa las frecuencias para dígitos 0-9

        for ($i = 0; $i < $n_chi; $i++) {
            $digito = intval($secuenciaAgrupacion[$i]);
            if ($digito >= 0 && $digito <= 9) { // Asegura que el dígito esté en el rango esperado
                $frecuenciaObservada[$digito]++;
            }
        }

        $chiCuadradoCalculado = 0;
        $chicuadradoFila = [];

        foreach ($frecuenciaObservada as $key => $valorObservado) {
            // Evita división por cero si npi es 0
            if ($npi > 0) {
                $aux = pow(($valorObservado - $npi), 2) / $npi;
                $chicuadradoFila[] = $aux;
                $chiCuadradoCalculado += $aux;
            } else {
                $this->warn("Advertencia: La frecuencia esperada (npi) es cero. No se puede calcular Chi Cuadrado.");
                $chiCuadradoCalculado = 0;
                break;
            }
        }

        // --- Mostrar Resultados de la Prueba de Chi Cuadrado ---
        $this->info("\nResultados de la Prueba de Chi Cuadrado:");
        $this->line("• N (Cantidad total de dígitos): {$n_chi}");
        $this->line("• k (Intervalos/dígitos): {$k}");
        $this->line("• Frecuencia Esperada (N/k): " . round($npi, 4));
        $this->line("• Grados de Libertad (gl): {$gl}");
        $this->line("• Chi Cuadrado Crítico (α=0.05): {$chiCuadradoCritico}");
        $this->line("• Chi Cuadrado Calculado: " . round($chiCuadradoCalculado, 4));

        $this->table(
            ['Dígito', 'F. Observada', 'F. Esperada (N/k)', '(Oi - Ei)^2 / Ei'],
            collect($frecuenciaObservada)->map(function ($freq, $digit) use ($npi, $chicuadradoFila) {
                return [
                    $digit,
                    $freq,
                    round($npi, 4),
                    isset($chicuadradoFila[$digit]) ? round($chicuadradoFila[$digit], 4) : 'N/A'
                ];
            })
        );

        if ($chiCuadradoCalculado < $chiCuadradoCritico) {
            $this->info("\n✔️ La prueba de Chi Cuadrado PASÓ. El valor calculado ({$chiCuadradoCalculado}) es MENOR que el valor crítico ({$chiCuadradoCritico}).");
            $this->info("Los números generados son aceptables como aleatorios con un nivel de confianza del 95%.");
        } else {
            $this->error("\n❌ La prueba de Chi Cuadrado FALLÓ. El valor calculado ({$chiCuadradoCalculado}) es MAYOR o IGUAL que el valor crítico ({$chiCuadradoCritico}).");
            $this->error("Los números generados NO son aceptables como aleatorios con un nivel de confianza del 95%.");
        }
    }
}
