<?php

namespace App\Http\Controllers;

use App\Models\Grupos;
use Illuminate\Http\Request;

class GruposController extends Controller
{
    public function index()
    {
        return response()->json(Grupos::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nombre' => 'required|string|max:100',
        ]);
        $grupo = Grupos::create($request->only('Nombre'));
        return response()->json($grupo, 201);
    }

    public function show($id)
    {
        $grupo = Grupos::findOrFail($id);
        return response()->json($grupo);
    }

    public function update(Request $request, $id)
    {
        $grupo = Grupos::findOrFail($id);
        $request->validate([
            'Nombre' => 'required|string|max:100',
        ]);
        $grupo->update($request->only('Nombre'));
        return response()->json($grupo);
    }

    public function destroy($id)
    {
        $grupo = Grupos::findOrFail($id);
        $grupo->delete();
        return response()->json(null, 204);
    }
}
