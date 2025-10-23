<?php

namespace App\Http\Controllers;

use App\Models\Horarios;
use Illuminate\Http\Request;

class HorariosController extends Controller
{
    public function index()
    {
        return response()->json(Horarios::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'Hora_Inicio' => 'required|date_format:H:i:s',
            'Hora_Fin' => 'required|date_format:H:i:s',
        ]);
        $horario = Horarios::create($request->only(['Hora_Inicio', 'Hora_Fin']));
        return response()->json($horario, 201);
    }

    public function show($id)
    {
        $horario = Horarios::findOrFail($id);
        return response()->json($horario);
    }

    public function update(Request $request, $id)
    {
        $horario = Horarios::findOrFail($id);
        $request->validate([
            'Hora_Inicio' => 'required|date_format:H:i:s',
            'Hora_Fin' => 'required|date_format:H:i:s',
        ]);
        $horario->update($request->only(['Hora_Inicio', 'Hora_Fin']));
        return response()->json($horario);
    }

    public function destroy($id)
    {
        $horario = Horarios::findOrFail($id);
        $horario->delete();
        return response()->json(null, 204);
    }
}
