<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Materia;
use App\Models\Grupos;
use App\Models\Aula;
use App\Models\Horarios;
use App\Models\DetalleHorario;

class DetalleHorarioSeeder extends Seeder
{
    public function run(): void
    {
        $materia = Materia::firstOrCreate(['Nombre' => 'Matemáticas I']);
        $grupo = Grupos::firstOrCreate(['Nombre' => 'Grupo A']);
        $aula = Aula::firstOrCreate(['Nro_Facultad' => 1, 'Nro_Aula' => 101]);
        $horario = Horarios::firstOrCreate(['Hora_Inicio' => '08:00:00', 'Hora_Fin' => '10:00:00']);

        DetalleHorario::firstOrCreate([
            'Materia_ID' => $materia->ID,
            'Grupo_ID' => $grupo->ID,
            'Aula_ID' => $aula->ID,
            'Horario_ID' => $horario->ID,
        ]);
    }
}
