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
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('venta_id') // Laravel asume 'ventas' y 'id'
                  ->constrained('ventas'); // Especifica la tabla a la que referencia (opcional si es por convención)
            $table->foreignId('pedido_id') // Laravel asume 'pedidos' y 'id'
                  ->constrained('pedidos'); // Especifica la tabla a la que referencia (opcional si es por convención)
            $table->string('tipo'); // tipo de movimiento: 'venta', 'pedido', 'demanda'
            $table->float('cantidad')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimientos');
    }
};
