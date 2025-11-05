<?php

namespace App\Http\Controllers;

use App\Models\DetalleDocente;
use App\Models\Asistencia;
use Illuminate\Http\Request;

class DetalleDocenteController extends Controller
{
    public function index()
    {
        return response()->json(DetalleDocente::with(['docente', 'asistencia', 'detalleHorario'])->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'ID_Docente' => 'required|integer|exists:Docente,ID',
            'ID_Detalle_Horario' => 'required|integer|exists:Detalle_Horario,ID',
            'ID_Asistencia' => 'nullable|integer|exists:Asistencia,ID',
        ]);

        // Si no se envía asistencia, usar el estado por defecto "Asignado"
        $asistenciaId = $request->input('ID_Asistencia');
        if ($asistenciaId === null) {
            $asignado = Asistencia::firstOrCreate(['Descripcion' => 'Asignado'], ['Descripcion' => 'Asignado']);
            $asistenciaId = $asignado->ID;
        }

        $payload = [
            'ID_Docente' => (int) $request->input('ID_Docente'),
            'ID_Detalle_Horario' => (int) $request->input('ID_Detalle_Horario'),
            'ID_Asistencia' => (int) $asistenciaId,
        ];

        $detalle = DetalleDocente::create($payload);
        return response()->json($detalle, 201);
    }

    public function show($id)
    {
        $detalle = DetalleDocente::with(['docente', 'asistencia', 'detalleHorario'])->findOrFail($id);
        return response()->json($detalle);
    }

    public function update(Request $request, $id)
    {
        $detalle = DetalleDocente::findOrFail($id);
        $request->validate([
            'ID_Docente' => 'sometimes|required|integer|exists:Docente,ID',
            'ID_Detalle_Horario' => 'sometimes|required|integer|exists:Detalle_Horario,ID',
            'ID_Asistencia' => 'nullable|integer|exists:Asistencia,ID',
        ]);

        $data = $request->only(['ID_Docente', 'ID_Detalle_Horario', 'ID_Asistencia']);
        // Si se envía ID_Asistencia null o no se envía, no forzamos cambio; si es null explícito, aplicamos por defecto
        if (array_key_exists('ID_Asistencia', $data)) {
            if ($data['ID_Asistencia'] === null) {
                $asignado = Asistencia::firstOrCreate(['Descripcion' => 'Asignado'], ['Descripcion' => 'Asignado']);
                $data['ID_Asistencia'] = $asignado->ID;
            }
        }

        $detalle->update($data);
        return response()->json($detalle);
    }

    public function destroy($id)
    {
        $detalle = DetalleDocente::findOrFail($id);
        $detalle->delete();
        return response()->json(null, 204);
    }
}
