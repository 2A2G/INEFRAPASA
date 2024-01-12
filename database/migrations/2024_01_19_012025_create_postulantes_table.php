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
            $table->id("postulante_id");
            $table->bigInteger("numeroIdentificacion_id");
            $table->bigInteger("cargo_id");
            $table->bigInteger('estado_id');
            $table->string("fotoPostulante");            
            $table->timestamps();

            
            $table->foreign("numeroIdentificacion_id")->references("numeroIdentificacion_id")->on("estudiantes");
            $table->foreign('estado_id')->references('estado_id')->on('estados');
            $table->foreign("cargo_id")->references("cargo_id")->on("cargos");
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
