<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('Aula', function (Blueprint $table) {
            $table->integer('ID')->primary();
            $table->integer('Nro_Facultad');
            $table->integer('Nro_Aula');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('Aula');
    }
};
