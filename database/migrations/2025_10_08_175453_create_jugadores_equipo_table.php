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
        Schema::create('jugadores_equipo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_liga') ;
            $table->foreignId('id_jugador') ;
            $table->foreignId('id_equipo') ;
            $table->double('clausula');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jugadores_equipo');

    }
};
