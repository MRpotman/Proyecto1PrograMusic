<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sello_discograficos', function (Blueprint $table) {
            $table->id('selloDiscograficoID');
            $table->string('nombre');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sello_discograficos');
    }
};