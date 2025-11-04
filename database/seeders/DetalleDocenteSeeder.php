<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Docente;
use App\Models\Asistencia;
use App\Models\DetalleHorario;
use App\Models\DetalleDocente;

class DetalleDocenteSeeder extends Seeder
{
    public function run(): void
    {
        $docente = Docente::firstOrCreate(
            ['Correo' => 'docente.prueba.2025@example.com'],
            [
                'Nombre' => 'Docente',
                'Apellido' => 'Prueba',
                'Registro' => 900001,
                'Contrasena' => 'prueba123',
                'Fecha_Nacimiento' => '1985-03-10',
                'Genero' => 'M',
                'Estado' => true,
            ]
        );

        $detalleHorario = DetalleHorario::first();
        $asistencia = Asistencia::firstOrCreate(['Descripcion' => 'Asignado']);

        if ($detalleHorario) {
            DetalleDocente::firstOrCreate([
                'ID_Docente' => $docente->ID,
                'ID_Asistencia' => $asistencia->ID,
                'ID_Detalle_Horario' => $detalleHorario->ID,
            ]);
        }
    }
}
