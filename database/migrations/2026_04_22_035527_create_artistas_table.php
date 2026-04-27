<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('artistas', function (Blueprint $table) {
            $table->id('artistaID');
            $table->string('nombre');
            $table->string('nacionalidad');
            $table->unsignedBigInteger('selloDiscograficoID');
            $table->foreign('selloDiscograficoID')->references('selloDiscograficoID')->on('sello_discograficos');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('artistas');
    }
};