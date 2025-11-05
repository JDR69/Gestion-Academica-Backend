<?php

namespace App\Http\Controllers;

use App\Models\DetalleHorario;
use Illuminate\Http\Request;

class DetalleHorarioController extends Controller
{
    public function index()
    {
        return response()->json(DetalleHorario::with(['materia', 'grupo', 'aula', 'horario', 'detalleDocentes'])->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'Materia_ID' => 'required|integer|exists:Materia,ID',
            'Grupo_ID' => 'required|integer|exists:Grupos,ID',
            'Aula_ID' => 'required|integer|exists:Aula,ID',
            'Horario_ID' => 'required|integer|exists:Horarios,ID',
        ]);
        $detalle = DetalleHorario::create($request->only(['Materia_ID', 'Grupo_ID', 'Aula_ID', 'Horario_ID']));
        return response()->json($detalle, 201);
    }

    public function show($id)
    {
        $detalle = DetalleHorario::with(['materia', 'grupo', 'aula', 'horario', 'detalleDocentes'])->findOrFail($id);
        return response()->json($detalle);
    }

    public function update(Request $request, $id)
    {
        $detalle = DetalleHorario::findOrFail($id);
        $request->validate([
            'Materia_ID' => 'required|integer|exists:Materia,ID',
            'Grupo_ID' => 'required|integer|exists:Grupos,ID',
            'Aula_ID' => 'required|integer|exists:Aula,ID',
            'Horario_ID' => 'required|integer|exists:Horarios,ID',
        ]);
        $detalle->update($request->only(['Materia_ID', 'Grupo_ID', 'Aula_ID', 'Horario_ID']));
        return response()->json($detalle);
    }

    // Marcar asistencia de un docente para una materia/horario
    public function marcarAsistencia(Request $request)
    {
        $request->validate([
            'ID_Docente' => 'required|integer|exists:Docente,ID',
            'ID_Detalle_Horario' => 'required|integer|exists:Detalle_Horario,ID',
            'ID_Asistencia' => 'required|integer|exists:Asistencia,ID',
        ]);

        // Buscar si ya existe el registro para ese docente y ese detalle de horario
        $detalle = \App\Models\DetalleDocente::where('ID_Docente', $request->ID_Docente)
            ->where('ID_Detalle_Horario', $request->ID_Detalle_Horario)
            ->first();

        if ($detalle) {
            // Si existe, actualiza la asistencia
            $detalle->ID_Asistencia = $request->ID_Asistencia;
            $detalle->save();
        } else {
            // Si no existe, crea el registro
            $detalle = \App\Models\DetalleDocente::create([
                'ID_Docente' => $request->ID_Docente,
                'ID_Detalle_Horario' => $request->ID_Detalle_Horario,
                'ID_Asistencia' => $request->ID_Asistencia,
            ]);
        }

        return response()->json($detalle, 201);
    }

    public function destroy($id)
    {
        $detalle = DetalleHorario::findOrFail($id);
        $detalle->delete();
        return response()->json(null, 204);
    }
}
