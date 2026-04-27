<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carrito_compras', function (Blueprint $table) {
            $table->id('carritoID');
            $table->unsignedBigInteger('usuarioID');
            $table->foreign('usuarioID')->references('usuarioID')->on('usuarios');
            $table->decimal('total', 8, 2)->default(0);
            $table->datetime('fechaCreacion')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carrito_compras');
    }
};