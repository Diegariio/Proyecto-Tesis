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
        Schema::create('tron_definicion_equipo', function (Blueprint $table) {
            $table->id('id_definicion');
            
            // Relaciones
            $table->unsignedBigInteger('id_registro_tratamiento');
            $table->unsignedBigInteger('id_equipo');
            
            // Campo específico
            $table->date('fecha_comite');
            
            $table->timestamps();

            // Claves foráneas
            $table->foreign('id_registro_tratamiento')->references('id_registro_tratamiento')->on('tron_registro_tratamiento');
            $table->foreign('id_equipo')->references('id_equipo')->on('tron_equipo_tratamiento');
            
            // Índice único para evitar duplicados
            $table->unique(['id_registro_tratamiento', 'id_equipo'], 'unique_registro_equipo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tron_definicion_equipo');
    }
};
