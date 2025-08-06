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
        Schema::create('paciente', function (Blueprint $table) {
            $table->string('rut')->primary();
            $table->string('numero_archivo', 8)->unique(); // Número de archivo único de máximo 8 dígitos
            $table->string('nombre');
            $table->string('primer_apellido');
            $table->string('segundo_apellido');
            $table->unsignedTinyInteger('edad'); // Edad del paciente (0-255)
            $table->unsignedBigInteger('id_comuna');
            $table->unsignedBigInteger('id_sexo');
            $table->unsignedBigInteger('id_servicio');
            $table->timestamps();

            $table->foreign('id_comuna')->references('id_comuna')->on('comuna');
            $table->foreign('id_sexo')->references('id_sexo')->on('sexo');
            $table->foreign('id_servicio')->references('id_servicio')->on('servicio_de_salud');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
