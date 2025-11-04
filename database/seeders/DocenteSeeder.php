<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Docente;

class DocenteSeeder extends Seeder
{
    public function run(): void
    {
        Docente::updateOrCreate(
            ['Correo' => 'docente.prueba.2025@example.com'],
            [
                'Nombre' => 'Docente',
                'Apellido' => 'Prueba',
                'Registro' => 900001,
                'Contrasena' => 'prueba123',
                'Correo' => 'docente.prueba.2025@example.com',
                'Fecha_Nacimiento' => '1985-03-10',
                'Genero' => 'M',
                'Estado' => true,
            ]
        );
    }
}
