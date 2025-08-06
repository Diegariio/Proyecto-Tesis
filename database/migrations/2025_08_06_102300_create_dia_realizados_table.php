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
        Schema::create('tron_dia_realizado', function (Blueprint $table) {
            $table->id('id_dia_realizado');
            
            // Relación con registro de tratamiento
            $table->unsignedBigInteger('id_registro_tratamiento');
            
            // Campos específicos
            $table->boolean('se_realizo')->default(false);
            $table->date('fecha_registro');
            
            $table->timestamps();

            // Clave foránea
            $table->foreign('id_registro_tratamiento')->references('id_registro_tratamiento')->on('tron_registro_tratamiento');
            
            // Índice para mejorar consultas
            $table->index('id_registro_tratamiento');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tron_dia_realizado');
    }
};
