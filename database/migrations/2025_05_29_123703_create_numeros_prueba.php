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
        Schema::create('numeros_prueba', function (Blueprint $table) {
            $table->id();
            $table->integer('resultado');

            $table->foreignId('semilla_prueba_id') // Laravel asume 'semillas_pruebas' y 'id'
                  ->constrained('semillas_pruebas') // Especifica la tabla a la que referencia (opcional si es por convención)
                  ->onDelete('cascade'); // Si la semilla_prueba se borra, los números asociados también
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('numeros_prueba');
    }
};
