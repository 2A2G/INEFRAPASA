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
        Schema::create('votos', function (Blueprint $table) {
            // $table->id();
            $table->bigIncrements('voto_id');
            $table->integer('postulante_id');
            $table->integer('cargo_id');
            $table->integer('estado_id');
            $table->string('cantidadVotos');
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
        Schema::dropIfExists('votos');
    }
};
