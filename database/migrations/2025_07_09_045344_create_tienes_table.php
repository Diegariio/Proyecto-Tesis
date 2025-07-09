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
        Schema::create('tiene', function (Blueprint $table) {
            $table->id('id_tiene');
            $table->string('rut');
            $table->unsignedBigInteger('id_codigo');
            $table->unsignedBigInteger('id_estado_proceso');
            $table->timestamps();

            $table->foreign('rut')->references('rut')->on('paciente');
            $table->foreign('id_codigo')->references('id_codigo')->on('codigo_cie10');
            $table->foreign('id_estado_proceso')->references('id_estado_proceso')->on('estado_proceso');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tienes');
    }
};
