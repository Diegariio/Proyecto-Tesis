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
        Schema::create('tron_registro_tratamiento', function (Blueprint $table) {
            $table->id('id_registro_tratamiento');
            
            // Relaciones principales
            $table->unsignedBigInteger('id_radioterapeuta');
            $table->string('rut'); // FK hacia tabla paciente
            
            // Nuevas relaciones
            $table->unsignedBigInteger('id_codigo_ges');
            $table->unsignedBigInteger('id_codigo_tratamiento');
            $table->unsignedBigInteger('id_zona');
            $table->unsignedBigInteger('id_quimioterapia_concominante');
            $table->unsignedBigInteger('id_codigo');
            
            // Campos del modelo
            $table->integer('n_sesiones_programadas');
            $table->string('intencion');
            $table->date('fecha_inicio');
            $table->date('fecha_termino');
            $table->date('fecha_simulacion_tratamiento');
            $table->date('fecha_indicacion');
            $table->boolean('cobertura_ges')->default(false);
            $table->string('horario_tratamiento');
            $table->text('observaciones')->nullable();

            $table->timestamps();

            // Claves foráneas
            $table->foreign('id_radioterapeuta')->references('id_radioterapeuta')->on('tron_radioterapeuta');
            $table->foreign('rut')->references('rut')->on('paciente');
            $table->foreign('id_codigo_ges')->references('id_codigo_ges')->on('tron_codigo_ges');
            $table->foreign('id_codigo_tratamiento')->references('id_codigo_tratamiento')->on('tron_codigo_tratamiento');
            $table->foreign('id_zona')->references('id_zona')->on('tron_zona_irradiada');
            $table->foreign('id_quimioterapia_concominante')->references('id_quimioterapia_concominante')->on('tron_quimioterapia_concominante');
            $table->foreign('id_codigo')->references('id_codigo')->on('codigo_cie10');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tron_registro_tratamiento');
    }
};
