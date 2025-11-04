<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Docente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // 1) Intentar login como admin (tabla users)
        $user = User::where('email', $credentials['email'])->first();
        if ($user && Hash::check($credentials['password'], $user->password)) {
            return response()->json([
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role ?? 'admin',
                ],
            ]);
        }

        // 2) Intentar login como docente (tabla Docente), contraseña en texto plano
        $docente = Docente::where('Correo', $credentials['email'])->first();
        if ($docente && $docente->Contrasena === $credentials['password']) {
            return response()->json([
                'user' => [
                    'id' => $docente->ID,
                    'name' => $docente->Nombre . ' ' . $docente->Apellido,
                    'email' => $docente->Correo,
                    'role' => 'teacher',
                    'docenteId' => $docente->ID,
                ],
            ]);
        }

        return response()->json(['message' => 'Credenciales inválidas'], 401);
    }
}
