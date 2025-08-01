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
        Schema::create('requerimiento', function (Blueprint $table) {
            $table->id('id_requerimiento');
            $table->text('requerimiento');
            $table->unsignedBigInteger('id_registro_requerimiento');
            $table->timestamps();
            $table->foreign('id_registro_requerimiento')->references('id_registro_requerimiento')->on('registro_requerimiento');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requerimientos');
    }
};
