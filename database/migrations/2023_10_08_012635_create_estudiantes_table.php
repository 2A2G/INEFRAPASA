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
        Schema::create('estudiantes', function (Blueprint $table) {
            // $table->id();
            $table->bigIncrements('estudiante_id');
            $table->string('numeroIdentificacion');
            $table->string('nombreCompleto');
            $table->integer('curso_id');
            $table->integer('estado_id');
            $table->string('sexo');
            $table->timestamps();

            $table->foreign('curso_id')->references('curso_id')->on('cursos');
            $table->foreign('estado_id')->references('estado_id')->on('estados');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiantes');
    }
};
