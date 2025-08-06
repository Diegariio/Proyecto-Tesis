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
        Schema::create('gestion_requerimiento', function (Blueprint $table) {
            $table->id('id_gestion_requerimiento');
            $table->unsignedBigInteger('id_registro_requerimiento');
            $table->unsignedBigInteger('id_gestion');
            $table->unsignedBigInteger('id_respuesta');
            $table->string('estado_gestion')->default('PENDIENTE');
            $table->date('fecha_gestion');
            $table->text('respuesta')->nullable();
            $table->timestamps();
            
            // Foreign keys
            $table->foreign('id_registro_requerimiento')->references('id_registro_requerimiento')->on('registro_requerimiento')->onDelete('cascade');
            $table->foreign('id_gestion')->references('id_gestion')->on('gestion')->onDelete('cascade');
            $table->foreign('id_respuesta')->references('id_respuesta')->on('respuestas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gestion_requerimiento');
    }
};
