<?php

namespace App\Http\Controllers;

use App\Models\DetalleHorario;
use App\Models\Horarios;
use App\Models\Aula;
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

        // Validación: no permitir el mismo aula en el mismo horario
        $existe = DetalleHorario::where('Aula_ID', $request->Aula_ID)
            ->where('Horario_ID', $request->Horario_ID)
            ->exists();

        if ($existe) {
            return response()->json([
                'message' => 'El aula ya está asignada a ese horario.'
            ], 422);
        }

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

    // Obtener aulas disponibles para un horario específico
    public function aulasDisponibles(Request $request)
    {
        $request->validate([
            'horario_id' => 'required|integer|exists:Horarios,ID',
        ]);
        
        $aulasOcupadas = DetalleHorario::where('Horario_ID', $request->horario_id)
            ->pluck('Aula_ID');
        
        $aulasDisponibles = Aula::whereNotIn('ID', $aulasOcupadas)->get();
        
        return response()->json($aulasDisponibles);
    }

    // Obtener horarios disponibles para un aula específica
    public function horariosDisponibles(Request $request)
    {
        $request->validate([
            'aula_id' => 'required|integer|exists:Aula,ID',
        ]);
        
        $horariosOcupados = DetalleHorario::where('Aula_ID', $request->aula_id)
            ->pluck('Horario_ID');
        
        $horariosDisponibles = Horarios::whereNotIn('ID', $horariosOcupados)->get();
        
        return response()->json($horariosDisponibles);
    }

}
