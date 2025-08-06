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
        Schema::create('resolucion_comite', function (Blueprint $table) {
            $table->id('id_resolucion_comite');
            $table->unsignedBigInteger('id_tiene');
            $table->string('resolucion_comite');
            $table->foreign('id_tiene')->references('id_tiene')->on('tiene');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resolucion_comites');
    }
};
