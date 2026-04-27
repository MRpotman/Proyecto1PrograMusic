<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('item_lista_deseos', function (Blueprint $table) {
            $table->id('itemListaID');
            $table->unsignedBigInteger('listaDeseosID');
            $table->foreign('listaDeseosID')->references('listaDeseosID')->on('lista_deseos');
            $table->unsignedBigInteger('productoID');
            $table->foreign('productoID')->references('productoID')->on('productos');
            $table->datetime('fechaAgregado')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_lista_deseos');
    }
};