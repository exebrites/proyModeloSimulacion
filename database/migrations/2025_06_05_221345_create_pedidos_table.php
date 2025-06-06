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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->float('cantidad_solicitada')->default(0);
            $table->float('cantidad_recibida')->default(0);
            $table->string('estado')->default('pendiente'); // pendiente, recibido, cancelado
            $table->integer('demora')->default(0); // en días
            $table->date('fecha_solicitud')->nullable();
            $table->date('fecha_cubierta')->nullable();
            $table->foreignId('numero_id') // Laravel asume 'numeros' y 'id'
                  ->constrained('numeros'); // Especifica la tabla a la que referencia (opcional si es por convención)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
