<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('Detalle_Docente', function (Blueprint $table) {
            $table->bigIncrements('ID');
            $table->integer('ID_Docente');
            $table->integer('ID_Asistencia');
            $table->integer('ID_Detalle_Horario');
            $table->foreign('ID_Docente')->references('ID')->on('Docente');
            $table->foreign('ID_Asistencia')->references('ID')->on('Asistencia');
            $table->foreign('ID_Detalle_Horario')->references('ID')->on('Detalle_Horario');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('Detalle_Docente');
    }
};
