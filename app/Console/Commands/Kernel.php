<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        // Tus comandos personalizados acá
        \App\Console\Commands\EjecutarFibonacciExtendido::class,
        
         \App\Console\Commands\EjecutarCongruenciaMixto::class,
    ];

    protected function schedule(Schedule $schedule): void
    {
        // Definí tareas programadas acá si necesitás
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
