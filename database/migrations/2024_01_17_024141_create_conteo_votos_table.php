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
        Schema::create('conteo_votos', function (Blueprint $table) {
            $table->id('conteoVotos_id');
            $table->integer('postulante_id');
            $table->integer('cargo_id');
            $table->integer('estado_id');
            $table->integer('totalVotos')->default(0); // Inicia el conteo de votos en 0
            $table->timestamps();

            $table->foreign('postulante_id')->references('postulante_id')->on('postulantes');
            $table->foreign('cargo_id')->references('cargo_id')->on('cargos');
            $table->foreign('estado_id')->references('estado_id')->on('estados');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conteo_votos');
    }
};
