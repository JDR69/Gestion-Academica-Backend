<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use Illuminate\Http\Request;

class AulaController extends Controller
{
    public function index()
    {
        return response()->json(Aula::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nro_Facultad' => 'required|integer',
            'Nro_Aula' => 'required|integer',
        ]);
        $aula = Aula::create($request->only(['Nro_Facultad', 'Nro_Aula']));
        return response()->json($aula, 201);
    }

    public function show($id)
    {
        $aula = Aula::findOrFail($id);
        return response()->json($aula);
    }

    public function update(Request $request, $id)
    {
        $aula = Aula::findOrFail($id);
        $request->validate([
            'Nro_Facultad' => 'required|integer',
            'Nro_Aula' => 'required|integer',
        ]);
        $aula->update($request->only(['Nro_Facultad', 'Nro_Aula']));
        return response()->json($aula);
    }

    public function destroy($id)
    {
        $aula = Aula::findOrFail($id);
        $aula->delete();
        return response()->json(null, 204);
    }
}
