<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lista_deseos', function (Blueprint $table) {
            $table->id('listaDeseosID');
            $table->unsignedBigInteger('usuarioID');
            $table->foreign('usuarioID')->references('usuarioID')->on('usuarios');
            $table->datetime('fechaCreacion')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lista_deseos');
    }
};