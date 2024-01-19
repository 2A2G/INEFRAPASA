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
            $table->integer('postulante_id')->nullable(); // Referencia al postulante
            $table->string('votoBlanco')->nullable(); // Indica si el voto fue en blanco. 'SI' para votos en blanco, NULL para votos a postulantes
            $table->integer('cargo_id'); // Referencia al cargo por el que se vota
            $table->integer('estado_id'); // Referencia al estado del voto
            $table->integer('totalVotos')->default(0); // Conteo de votos para este postulante o voto en blanco
            $table->timestamps();

            $table->unique(['postulante_id', 'votoBlanco']); // Cada combinación de postulante y voto en blanco es única
            $table->foreign('postulante_id')->references('postulante_id')->on('postulantes'); // Relación con la tabla de postulantes
            $table->foreign('cargo_id')->references('cargo_id')->on('cargos'); // Relación con la tabla de cargos
            $table->foreign('estado_id')->references('estado_id')->on('estados'); // Relación con la tabla de estados
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
