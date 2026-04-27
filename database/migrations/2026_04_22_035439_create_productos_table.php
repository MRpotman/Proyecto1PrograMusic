<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id('productoID');
            $table->string('nombre');
            $table->string('album');
            $table->decimal('precio', 8, 2);
            $table->integer('stock');
            $table->datetime('fechaLanzamiento');
            $table->string('imagen')->nullable();
            $table->unsignedBigInteger('artistaID');
            $table->foreign('artistaID')->references('artistaID')->on('artistas');
            $table->unsignedBigInteger('generoID');
            $table->foreign('generoID')->references('generoID')->on('generos');
            $table->unsignedBigInteger('tipoProductoID');
            $table->foreign('tipoProductoID')->references('tipoProductoID')->on('tipo_productos');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};