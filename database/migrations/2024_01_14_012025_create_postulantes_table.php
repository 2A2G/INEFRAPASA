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
            // $table->id();
            $table->bigIncrements("postulante_id");
            $table->integer('estudiante_id');
            $table->integer("cargo_id");
            $table->integer('estado_id');
            $table->timestamps();


            $table->foreign("estudiante_id")->references("estudiante_id")->on("estudiantes");
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
