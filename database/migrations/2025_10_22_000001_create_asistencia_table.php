<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('Asistencia', function (Blueprint $table) {
            $table->integer('ID')->primary();
            $table->string('Descripcion', 20);
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('Asistencia');
    }
};
