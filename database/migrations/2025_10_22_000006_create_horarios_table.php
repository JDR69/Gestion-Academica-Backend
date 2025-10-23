<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('Horarios', function (Blueprint $table) {
            $table->integer('ID')->primary();
            $table->time('Hora_Inicio');
            $table->time('Hora_Fin');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('Horarios');
    }
};
