<?php

namespace App\Http\Controllers;

use App\Models\Docente;
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
}
