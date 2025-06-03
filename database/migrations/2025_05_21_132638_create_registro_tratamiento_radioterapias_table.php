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

            $table->unsignedBigInteger('id_diagnostico');
            $table->unsignedBigInteger('id_zona');
            $table->unsignedBigInteger('id_equipo');
            $table->unsignedBigInteger('id_radioterapeuta');
            $table->unsignedBigInteger('id_codigo_tratamiento');
            $table->unsignedBigInteger('id_codigo_ges');
            $table->unsignedBigInteger('id_quimioterapia_concominante')->nullable();

            $table->string('tipo_atencion');
            $table->integer('n_sesiones_programadas');
            $table->integer('n_sesiones_realizadas');
            $table->string('intencion')->nullable();
            $table->date('fecha_indicacion')->nullable();
            $table->date('fecha_comite')->nullable();
            $table->date('fecha_simulacion')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_termino')->nullable();
            $table->boolean('cobertura_ges')->default(false);
            $table->string('horario')->nullable();
            $table->string('tipo_tratamiento')->nullable();
            $table->text('observaciones')->nullable();

            $table->timestamps();

            // Claves foráneas
            $table->foreign('id_diagnostico')->references('id_diagnostico')->on('tron_diagnostico');
            $table->foreign('id_zona')->references('id_zona')->on('tron_zona_irradiada');
            $table->foreign('id_equipo')->references('id_equipo')->on('tron_equipo_tratamiento');
            $table->foreign('id_radioterapeuta')->references('id_radioterapeuta')->on('tron_radioterapeuta');
            $table->foreign('id_codigo_tratamiento')->references('id_codigo_tratamiento')->on('tron_codigo_tratamiento');
            $table->foreign('id_codigo_ges')->references('id_codigo_ges')->on('tron_codigo_ges');
            $table->foreign('id_quimioterapia_concominante')->references('id_quimioterapia_concominante')->on('tron_quimioterapia_concominante');
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
