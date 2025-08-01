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
        Schema::create('registro_requerimiento', function (Blueprint $table) {
            $table->id('id_registro_requerimiento');
            $table->unsignedBigInteger('id_codigo');
            $table->unsignedBigInteger('id_gestion');
            $table->string('rut');
            $table->unsignedBigInteger('id_categoria');
            $table->unsignedBigInteger('id_responsable');
            $table->unsignedBigInteger('id_entidad');
            $table->unsignedBigInteger('id_emisor');
            $table->date('fecha')->nullable();
            $table->text('resolucion_comite')->nullable();
            $table->date('fecha_proxima_revision')->nullable();
            $table->text('resolucion_caso')->nullable();
            $table->date('fecha_gestion')->nullable();
            $table->text('respuesta')->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('id_requerimiento');
            $table->foreign('id_codigo')->references('id_codigo')->on('codigo_cie10');
            $table->foreign('id_gestion')->references('id_gestion')->on('gestion');
            $table->foreign('rut')->references('rut')->on('paciente');
            $table->foreign('id_categoria')->references('id_categoria')->on('categoria');
            $table->foreign('id_responsable')->references('id_responsable')->on('responsable');
            $table->foreign('id_entidad')->references('id_entidad')->on('entidad_que_resuelve');
            $table->foreign('id_emisor')->references('id_emisor')->on('emisor_requerimiento');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registro_requerimientos');
    }
};
