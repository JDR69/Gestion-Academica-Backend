<?php

namespace App\Http\Controllers;

use App\Models\DetalleDocente;
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
            'ID_Asistencia' => 'required|integer|exists:Asistencia,ID',
            'ID_Detalle_Horario' => 'required|integer|exists:Detalle_Horario,ID',
        ]);
        $detalle = DetalleDocente::create($request->only(['ID_Docente', 'ID_Asistencia', 'ID_Detalle_Horario']));
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
            'ID_Docente' => 'required|integer|exists:Docente,ID',
            'ID_Asistencia' => 'required|integer|exists:Asistencia,ID',
            'ID_Detalle_Horario' => 'required|integer|exists:Detalle_Horario,ID',
        ]);
        $detalle->update($request->only(['ID_Docente', 'ID_Asistencia', 'ID_Detalle_Horario']));
        return response()->json($detalle);
    }

    public function destroy($id)
    {
        $detalle = DetalleDocente::findOrFail($id);
        $detalle->delete();
        return response()->json(null, 204);
    }
}
