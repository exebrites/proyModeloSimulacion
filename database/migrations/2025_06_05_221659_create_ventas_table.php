<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->float('cantidad')->default(0);
            $table->date('fecha')->nullable();
            $table->foreignId('demanda_id') // Laravel asume 'demandas' y 'id'
                  ->constrained('demandas'); // Especifica la tabla a la que referencia (opcional si es por convención)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
