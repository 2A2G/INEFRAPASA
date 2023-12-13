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
        Schema::create('postulantes', function (Blueprint $table) {
            $table->id();
            $table->string("numero_identificacion_postulante");
            $table->string("nombre_postulante")->nullable();
            $table->string("cargo_postulante")->foreign('cargo_postulante')->references('id')->on('cargos')->onDelete('cascade')->nullable();
            $table->string("foto_postulante");
            $table->string("curso_postulante");
            $table->integer("votos_postulante")->nullable();
            $table->string("estado_postulante")->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('postulantes');
    }
};
