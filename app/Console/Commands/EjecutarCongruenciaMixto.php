<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SemillaPrueba; // Modelo para la tabla 'semillas_pruebas'
use App\Models\NumerosPrueba;  // Modelo para la tabla 'numeros_prueba' (singular)

class EjecutarCongruenciaMixto extends Command
{
    // Define la firma del comando y su descripción.
    // Los argumentos {x0}, {a}, {c}, {m}, {n} son obligatorios y se corresponden
    // con los parámetros del LCG Mixto: (semilla_inicial, multiplicador, incremento, modulo, cantidad_numeros)
    protected $signature = 'lcg:mixto {x0} {a} {c} {m} {n}';
    protected $description = 'Genera números con el método Congruencial Lineal Mixto (LCG) para pruebas de consola, los guarda y ejecuta la prueba de Chi Cuadrado por intervalos.';

    /**
     * El método `handle` es el punto de entrada principal para la ejecución de este comando Artisan.
     * Aquí se implementa la lógica del LCG, el almacenamiento y la prueba de Chi Cuadrado.
     */
    public function handle()
    {
        // 1. Obtener los parámetros del LCG desde los argumentos de la línea de comandos.
        // Se utilizan (int) para asegurar que los valores son enteros.
        $x0 = (int) $this->argument('x0'); // Semilla inicial (X0)
        $a = (int) $this->argument('a');   // Multiplicador (a)
        $c = (int) $this->argument('c');   // Incremento (c)
        $m = (int) $this->argument('m');   // Módulo (m)
        $n = (int) $this->argument('n');   // Cantidad de números a generar

        // --- 2. Gestión de la Semilla en la Base de Datos de Pruebas ---
        // Buscamos si ya existe una combinación idéntica de X0, 'a' y 'm' en la tabla 'semillas_pruebas'.
        // Esto previene duplicados para la misma configuración de LCG.
        $existe = SemillaPrueba::where('v1', $x0) // Usamos 'v1' para guardar X0 (la semilla)
                         ->where('v2', $a) // Usamos 'v2' para guardar el multiplicador 'a'
                         ->where('m', $m) // Usamos 'm' para guardar el módulo 'm'
                         ->first();

        // Si la combinación de parámetros ya existe, notificamos al usuario y salimos.
        if ($existe) {
            $this->error('La semilla/parámetros LCG ingresados ya existen en la base de datos de pruebas (ID: ' . $existe->id . ').');
            return Command::FAILURE; // Indica que el comando terminó con un fallo.
        }

        // Si no existe, creamos un nuevo registro en la tabla 'semillas_pruebas'.
        // 'metodo' se establece como 'lcg_mixto' para diferenciarlo de otros generadores.
        $semilla = SemillaPrueba::create([
            'v1' => $x0,
            'v2' => $a,
            'm' => $m,
            'metodo' => 'lcg_mixto'
        ]);

        $numerosGenerados = []; // Este array almacenará la secuencia de números generados.
        $current_xi = $x0;      // Inicializamos el valor actual del LCG con la semilla X0.

        // --- 3. Generación de la Secuencia de Números LCG Mixto ---
        // Iteramos 'n' veces para generar la cantidad de números solicitada.
        for ($i = 0; $i < $n; $i++) {
            // Aplicamos la fórmula del Generador Congruencial Lineal Mixto: X_i = (a * X_{i-1} + c) % M
            $current_xi = ($a * $current_xi + $c) % $m;
            $numerosGenerados[] = $current_xi; // Añadimos el número generado al array.
        }

        // --- 4. Almacenamiento de los Números Generados en la Base de Datos de Pruebas ---
        $datosParaGuardar = []; // Array para preparar los datos para una inserción masiva (más eficiente).
        foreach ($numerosGenerados as $num) {
            // Cada número se asocia con el ID de la semilla de prueba recién creada.
            // Asegúrate de que la columna de clave foránea en 'numeros_prueba' se llame 'semilla_prueba_id'.
            $datosParaGuardar[] = [
                'resultado' => $num,
                'semilla_prueba_id' => $semilla->id
            ];
        }
        // Insertamos todos los números generados en la tabla 'numeros_prueba' de una sola vez.
        NumerosPrueba::insert($datosParaGuardar);

        // --- 5. Mostrar Información de la Generación en la Consola ---
        $this->info("--- Generación de LCG Mixto ---");
        $this->info("Parámetros LCG: X0={$x0}, a={$a}, c={$c}, M={$m}, n={$n}");
        $this->info("Semilla de Prueba guardada con ID: {$semilla->id}");
        $this->info("Números generados (" . count($numerosGenerados) . " en total):");

        // Para evitar saturar la consola con muchos números, mostramos solo los primeros 10 y los últimos 5.
        $displayCount = min(count($numerosGenerados), 10); // Muestra hasta 10 números iniciales.
        for ($i = 0; $i < $displayCount; $i++) {
            $this->line("[$i] → {$numerosGenerados[$i]}");
        }
        if (count($numerosGenerados) > $displayCount) {
            $this->line("..."); // Indicador de que hay más números.
            // Muestra los últimos 5 números si la secuencia es lo suficientemente larga.
            $startFrom = max(0, count($numerosGenerados) - 5);
            for ($i = $startFrom; $i < count($numerosGenerados); $i++) {
                $this->line("[$i] → {$numerosGenerados[$i]}");
            }
        }

        // --- 6. Ejecutar la Prueba de Chi Cuadrado ---
        // Se llama al método privado 'runChiSquaredTest' para analizar la secuencia generada.
        // Ahora pasamos el módulo 'm' para que la prueba pueda definir los intervalos correctamente.
        $this->runChiSquaredTest($numerosGenerados, $m);

        return Command::SUCCESS; // Indica que el comando se ejecutó exitosamente.
    }

    /**
     * Método privado para realizar la Prueba de Chi Cuadrado sobre la uniformidad de los números generados
     * en intervalos, y mostrar los resultados por consola.
     *
     * @param array $numerosGenerados Array de números enteros que se utilizarán para la prueba.
     * @param int $modulo El módulo (M) del LCG, usado para definir el rango de los números generados.
     */
    private function runChiSquaredTest(array $numerosGenerados, int $modulo): void
    {
        $this->info("\n--- Iniciando Prueba de Chi Cuadrado (por Intervalos) ---");

        $n_total_numeros = count($numerosGenerados); // Cantidad total de números generados.
        $k = 10; // Número de intervalos (categorías) para la prueba de uniformidad.

        // Verificación para asegurar que hay suficientes números para la prueba.
        if ($n_total_numeros === 0) {
            $this->error("No hay números para realizar la prueba de Chi Cuadrado.");
            return;
        }

        // Calcular el tamaño de cada intervalo. El rango de los números generados es [0, modulo - 1].
        $intervalo_size = $modulo / $k;

        // Advertencia si el módulo no es divisible por k, ya que los intervalos no serán de tamaño exacto.
        // Para pruebas más rigurosas, se elegiría un k que sea divisor del módulo, o se ajustarían los intervalos.
        if ($modulo % $k !== 0) {
            $this->warn("Advertencia: El módulo ({$modulo}) no es divisible por el número de intervalos ({$k}). Los intervalos no serán de tamaño exacto.");
        }

        // Inicializar un array para almacenar las frecuencias observadas (Oi) para cada intervalo.
        $frecuenciaObservada = array_fill(0, $k, 0); // Índices 0 a k-1 para los intervalos.

        // Asignar cada número generado a su intervalo correspondiente.
        foreach ($numerosGenerados as $num) {
            // Calcular el índice del intervalo al que pertenece el número.
            $intervalo_index = floor($num / $intervalo_size);

            // Ajustar el índice para el último intervalo si el número es el máximo posible (modulo - 1).
            // Esto asegura que el número más grande caiga en el último intervalo válido.
            if ($intervalo_index >= $k) {
                $intervalo_index = $k - 1;
            }
            $frecuenciaObservada[$intervalo_index]++; // Incrementa el contador para ese intervalo.
        }

        // Frecuencia esperada (Ei): N / k.
        $npi = $n_total_numeros / $k;
        // Grados de libertad (gl): k - 1.
        $gl = $k - 1;

        // Valor crítico de Chi Cuadrado para un nivel de significancia de α=0.05 y gl=9.
        // Este valor se obtiene de tablas estadísticas de Chi Cuadrado.
        $chiCuadradoCritico = 16.919;

        // Calcular el estadístico Chi Cuadrado observado (sumatoria de (Oi - Ei)^2 / Ei).
        $chiCuadradoCalculado = 0;
        $chicuadradoFila = []; // Almacena las contribuciones individuales de cada intervalo para la tabla.

        foreach ($frecuenciaObservada as $index => $valorObservado) {
            // Asegura que la frecuencia esperada no sea cero para evitar división por cero.
            if ($npi > 0) {
                // Fórmula de la contribución al Chi Cuadrado: (Frecuencia Observada - Frecuencia Esperada)^2 / Frecuencia Esperada
                $aux = pow(($valorObservado - $npi), 2) / $npi;
                $chicuadradoFila[] = $aux;
                $chiCuadradoCalculado += $aux; // Suma la contribución al total calculado.
            } else {
                $this->warn("Advertencia: La frecuencia esperada (N/k) es cero. No se puede calcular Chi Cuadrado para este intervalo.");
                $chiCuadradoCalculado = 0; // Si N/k es 0, la prueba no es válida.
                break; // Salimos del bucle si no se puede realizar el cálculo.
            }
        }

        // --- Mostrar Resultados Detallados de la Prueba de Chi Cuadrado en la Consola ---
        $this->info("\nResultados de la Prueba de Chi Cuadrado (por Intervalos):");
        $this->line("• N (Cantidad total de números): {$n_total_numeros}");
        $this->line("• k (Número de Intervalos): {$k}");
        $this->line("• Rango de números del LCG: [0, " . ($modulo - 1) . "]");
        $this->line("• Tamaño aproximado de cada intervalo: " . round($intervalo_size, 2));
        $this->line("• Frecuencia Esperada (N/k): " . round($npi, 4));
        $this->line("• Grados de Libertad (gl): {$gl}");
        $this->line("• Chi Cuadrado Crítico (α=0.05): {$chiCuadradoCritico}");
        $this->line("• Chi Cuadrado Calculado: " . round($chiCuadradoCalculado, 4));

        // Muestra una tabla detallada con las frecuencias observadas y esperadas por cada intervalo.
        $this->table(
            ['Intervalo', 'F. Observada', 'F. Esperada (N/k)', '(Oi - Ei)^2 / Ei'],
            collect($frecuenciaObservada)->map(function ($freq, $interval_idx) use ($npi, $chicuadradoFila, $intervalo_size) {
                $start = round($interval_idx * $intervalo_size);
                $end = round(($interval_idx + 1) * $intervalo_size - 1);
                return [
                    "[{$start} - {$end}]",
                    $freq,
                    round($npi, 4),
                    isset($chicuadradoFila[$interval_idx]) ? round($chicuadradoFila[$interval_idx], 4) : 'N/A'
                ];
            })
        );

        // Conclusión final de la prueba (PASA o FALLA) basada en la comparación del valor calculado y crítico.
        if ($chiCuadradoCalculado < $chiCuadradoCritico) {
            $this->info("\n✔️ La prueba de Chi Cuadrado PASÓ. El valor calculado ({$chiCuadradoCalculado}) es MENOR que el valor crítico ({$chiCuadradoCritico}).");
            $this->info("Los números generados son aceptables como aleatorios con un nivel de confianza del 95%.");
        } else {
            $this->error("\n❌ La prueba de Chi Cuadrado FALLÓ. El valor calculado ({$chiCuadradoCalculado}) es MAYOR o IGUAL que el valor crítico ({$chiCuadradoCritico}).");
            $this->error("Los números generados NO son aceptables como aleatorios con un nivel de confianza del 95%.");
        }
    }
}
