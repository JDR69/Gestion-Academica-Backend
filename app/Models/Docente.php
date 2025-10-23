<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    protected $table = 'Docente';
    protected $primaryKey = 'ID';
    public $timestamps = false;
    protected $fillable = ['Nombre', 'Apellido', 'Registro', 'Contrasena', 'Correo', 'Fecha_Nacimiento', 'Genero', 'Estado'];
    public $incrementing = true;
    protected $keyType = 'int';

    public function detalleDocentes()
    {
        return $this->hasMany(DetalleDocente::class, 'ID_Docente', 'ID');
    }
}
