<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('item_carritos', function (Blueprint $table) {
            $table->id('itemCarritoID');
            $table->unsignedBigInteger('carritoID');
            $table->foreign('carritoID')
          ->references('carritoID')
          ->on('carrito_compras')
          ->onDelete('cascade');
            $table->unsignedBigInteger('productoID');
            $table->foreign('productoID')->references('productoID')->on('productos');
            $table->integer('cantidad');
            $table->decimal('precioUnitario', 8, 2);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_carritos');
    }
};