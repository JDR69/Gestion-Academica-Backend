<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{
    public function index()
    {
        return response()->json(Asistencia::with('detalleDocentes')->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'Descripcion' => 'required|string|max:20',
        ]);
        $asistencia = Asistencia::create($request->only(['Descripcion']));
        return response()->json($asistencia, 201);
    }

    public function show($id)
    {
        $asistencia = Asistencia::with('detalleDocentes')->findOrFail($id);
        return response()->json($asistencia);
    }

    public function update(Request $request, $id)
    {
        $asistencia = Asistencia::findOrFail($id);
        $request->validate([
            'Descripcion' => 'required|string|max:20',
        ]);
        $asistencia->update($request->only(['Descripcion']));
        return response()->json($asistencia);
    }

    public function destroy($id)
    {
        $asistencia = Asistencia::findOrFail($id);
        $asistencia->delete();
        return response()->json(null, 204);
    }
}
