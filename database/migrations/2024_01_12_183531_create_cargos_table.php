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
        Schema::create('cargos', function (Blueprint $table) {
            Schema::create('cargos', function (Blueprint $table) {
                $table->id('cargo_id');
                $table->bigInteger('estado_id');
                $table->string('nombreCargo');
                $table->string('descripcionCargo');
                $table->timestamps();

                $table->foreign('estado_id')->references('estado_id')->on('estados');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cargos');
    }
};
