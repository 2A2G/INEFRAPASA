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
        Schema::create('photos', function (Blueprint $table) {
            $table->id('photo_id');
            $table->string('imagenCandidato');
            $table->integer('postulante_id');
            $table->integer('estado_id');
            $table->timestamps();

            $table->foreign('estado_id')->references('estado_id')->on('estados');
            $table->foreign('postulante_id')->references('postulante_id')->on('postulantes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photos');
    }
};
