<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Asistencia;

class AsistenciaSeeder extends Seeder
{
    public function run(): void
    {
        Asistencia::updateOrCreate(['ID' => 1], ['Descripcion' => 'Asignado']);
        Asistencia::updateOrCreate(['ID' => 2], ['Descripcion' => 'Presente']);
        Asistencia::updateOrCreate(['ID' => 3], ['Descripcion' => 'Ausente']);
    }
}
