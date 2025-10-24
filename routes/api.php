<?php

use Illuminate\Support\Facades\Route;

// CRUD Controllers
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\GruposController;
use App\Http\Controllers\AulaController;
use App\Http\Controllers\HorariosController;
use App\Http\Controllers\DetalleHorarioController;
use App\Http\Controllers\DetalleDocenteController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\AuthController;

Route::apiResource('materia', MateriaController::class);
Route::apiResource('grupos', GruposController::class);
Route::apiResource('aula', AulaController::class);
Route::apiResource('horarios', HorariosController::class);
Route::apiResource('detalle-horario', DetalleHorarioController::class);
Route::apiResource('detalle-docente', DetalleDocenteController::class);
Route::apiResource('docente', DocenteController::class);
Route::apiResource('asistencia', AsistenciaController::class);

// Auth
Route::post('login', [AuthController::class, 'login']);
