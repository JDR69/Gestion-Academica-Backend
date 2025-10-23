<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('Detalle_Horario', function (Blueprint $table) {
            $table->bigIncrements('ID');
            $table->integer('Materia_ID');
            $table->integer('Grupo_ID');
            $table->integer('Aula_ID');
            $table->integer('Horario_ID');
            $table->foreign('Materia_ID')->references('ID')->on('Materia');
            $table->foreign('Grupo_ID')->references('ID')->on('Grupos');
            $table->foreign('Aula_ID')->references('ID')->on('Aula');
            $table->foreign('Horario_ID')->references('ID')->on('Horarios');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('Detalle_Horario');
    }
};
