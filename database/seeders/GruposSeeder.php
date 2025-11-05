<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Grupos;

class GruposSeeder extends Seeder
{
    public function run(): void
    {
        Grupos::updateOrCreate(['Nombre' => 'Grupo A'], []);
        Grupos::updateOrCreate(['Nombre' => 'Grupo B'], []);
    }
}
