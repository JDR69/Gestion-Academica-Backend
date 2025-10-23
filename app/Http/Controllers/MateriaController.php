<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    public function index()
    {
        return response()->json(Materia::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nombre' => 'required|string|max:100',
        ]);
        $materia = Materia::create($request->only('Nombre'));
        return response()->json($materia, 201);
    }

    public function show($id)
    {
        $materia = Materia::findOrFail($id);
        return response()->json($materia);
    }

    public function update(Request $request, $id)
    {
        $materia = Materia::findOrFail($id);
        $request->validate([
            'Nombre' => 'required|string|max:100',
        ]);
        $materia->update($request->only('Nombre'));
        return response()->json($materia);
    }

    public function destroy($id)
    {
        $materia = Materia::findOrFail($id);
        $materia->delete();
        return response()->json(null, 204);
    }
}
