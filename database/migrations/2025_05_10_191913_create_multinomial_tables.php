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
        Schema::create('multinomial_result_category', function (Blueprint $table) {
            $table->foreignId('result_id')->constrained('multinomial_results')->cascadeOnDelete();
            $table->foreignId('category_id')->constrained('multinomial_categories');
            $table->unsignedInteger('count');
            $table->decimal('theoretical_probability', 8, 6);
            $table->primary(['result_id', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('multinomial_result_category'); // Cambiado para coincidir con el nombre real
    }
};
