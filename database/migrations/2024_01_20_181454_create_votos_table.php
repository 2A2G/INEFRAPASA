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
            $table->bigIncrements('voto_id');
            $table->integer('estudiante_id');
            $table->integer('cargo_id');
            $table->integer('estado_id');
            $table->timestamps();
        
            $table->foreign('estudiante_id')->references('estudiante_id')->on('estudiantes');
            $table->foreign('cargo_id')->references('cargo_id')->on('cargos');
            $table->foreign('estado_id')->references('estado_id')->on('estados');
        
            $table->unique(['estudiante_id', 'cargo_id']); // Asegura que la votación sea única por cargo
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
