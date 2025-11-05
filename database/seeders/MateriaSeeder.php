<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Materia;

class MateriaSeeder extends Seeder
{
    public function run(): void
    {
        Materia::updateOrCreate(['Nombre' => 'Matemáticas I'], []);
        Materia::updateOrCreate(['Nombre' => 'Álgebra Lineal'], []);
    }
}
