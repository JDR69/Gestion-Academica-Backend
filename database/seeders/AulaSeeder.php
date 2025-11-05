<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Aula;

class AulaSeeder extends Seeder
{
    public function run(): void
    {
        Aula::updateOrCreate(['Nro_Facultad' => 1, 'Nro_Aula' => 101], []);
        Aula::updateOrCreate(['Nro_Facultad' => 1, 'Nro_Aula' => 203], []);
    }
}
