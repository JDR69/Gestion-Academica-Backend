<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Horarios;

class HorariosSeeder extends Seeder
{
    public function run(): void
    {
        Horarios::updateOrCreate(['Hora_Inicio' => '08:00:00', 'Hora_Fin' => '10:00:00'], []);
        Horarios::updateOrCreate(['Hora_Inicio' => '10:00:00', 'Hora_Fin' => '12:00:00'], []);
    }
}
