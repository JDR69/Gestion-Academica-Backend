<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('Docente', function (Blueprint $table) {
            $table->integer('ID')->primary();
            $table->string('Nombre', 50);
            $table->string('Apellido', 50);
            $table->integer('Registro');
            $table->string('Contrasena', 250);
            $table->string('Correo', 50);
            $table->date('Fecha_Nacimiento');
            $table->string('Genero', 10);
            $table->boolean('Estado')->nullable();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('Docente');
    }
};
