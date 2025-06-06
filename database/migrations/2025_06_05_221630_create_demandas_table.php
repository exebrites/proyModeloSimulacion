<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Numeros;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('demandas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('numero_id') // Laravel asume 'numeros' y 'id'
                  ->constrained('numeros'); // Especifica la tabla a la que referencia (opcional si es por convención)
            $table->foreignId('stock_id') // Laravel asume 'stocks' y 'id'
                  ->constrained('stocks'); // Especifica la tabla a la que referencia (opcional si es por convención)
            $table->float('cantidad_solicitada')->default(0);
            $table->float('cantidad_cubierta')->default(0);
            $table->string('estado')->default('pendiente'); // pendiente, satisfecho, cancelado
            $table->date('fecha');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demandas');
    }
};
