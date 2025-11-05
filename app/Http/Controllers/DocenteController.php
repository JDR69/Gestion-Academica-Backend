<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\DetalleDocente;
use Illuminate\Http\Request;

class DocenteController extends Controller
{
    public function index()
    {
        return response()->json(Docente::with('detalleDocentes')->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nombre' => 'required|string|max:50',
            'Apellido' => 'required|string|max:50',
            'Registro' => 'required|integer',
            'Contrasena' => 'required|string|max:250',
            'Correo' => 'required|string|max:50',
            'Fecha_Nacimiento' => 'required|date',
            'Genero' => 'required|string|max:10',
            'Estado' => 'nullable|boolean',
        ]);
        $docente = Docente::create($request->only(['Nombre', 'Apellido', 'Registro', 'Contrasena', 'Correo', 'Fecha_Nacimiento', 'Genero', 'Estado']));
        return response()->json($docente, 201);
    }

    public function show($id)
    {
        $docente = Docente::with('detalleDocentes')->findOrFail($id);
        return response()->json($docente);
    }

    public function update(Request $request, $id)
    {
        $docente = Docente::findOrFail($id);
        $request->validate([
            'Nombre' => 'required|string|max:50',
            'Apellido' => 'required|string|max:50',
            'Registro' => 'required|integer',
            'Contrasena' => 'required|string|max:250',
            'Correo' => 'required|string|max:50',
            'Fecha_Nacimiento' => 'required|date',
            'Genero' => 'required|string|max:10',
            'Estado' => 'nullable|boolean',
        ]);
        $docente->update($request->only(['Nombre', 'Apellido', 'Registro', 'Contrasena', 'Correo', 'Fecha_Nacimiento', 'Genero', 'Estado']));
        return response()->json($docente);
    }

    public function destroy($id)
    {
        $docente = Docente::findOrFail($id);
        $docente->delete();
        return response()->json(null, 204);
    }

    /**
     * Retorna los horarios asignados al docente (Detalla Materia, Grupo, Aula y Horario).
     */
    public function horarios($id)
    {
        $docente = Docente::findOrFail($id);

        // Traer los Detalle_Docente con el Detalle_Horario y sus relaciones
        $detalles = $docente->detalleDocentes()
            ->with([
                'detalleHorario.materia',
                'detalleHorario.grupo',
                'detalleHorario.aula',
                'detalleHorario.horario',
            ])->get();

        // Filtrar por Detalle_Horario únicos (un mismo horario puede tener varias asistencias)
        $unicosPorDetalleHorario = $detalles->unique(fn ($d) => optional($d->detalleHorario)->ID);

        $result = $unicosPorDetalleHorario->map(function ($d) {
            $dh = $d->detalleHorario;
            return [
                'detalle_horario_id' => $dh?->ID,
                'materia' => $dh?->materia?->Nombre,
                'grupo' => $dh?->grupo?->Nombre,
                'aula' => $dh?->aula ? [
                    'nro_facultad' => $dh->aula->Nro_Facultad,
                    'nro_aula' => $dh->aula->Nro_Aula,
                ] : null,
                'hora_inicio' => $dh?->horario?->Hora_Inicio,
                'hora_fin' => $dh?->horario?->Hora_Fin,
            ];
        })->values();

        return response()->json([
            'docente_id' => $docente->ID,
            'docente_nombre' => $docente->Nombre,
            'docente_apellido' => $docente->Apellido,
            'horarios' => $result,
        ]);
    }
}
