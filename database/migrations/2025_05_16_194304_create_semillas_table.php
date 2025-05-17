<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('semillas', function (Blueprint $table) {
            $table->id();
            $table->integer('v1');
            $table->integer('v2');
            $table->integer('m');
            $table->string('metodo');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('semillas');
    }
};
