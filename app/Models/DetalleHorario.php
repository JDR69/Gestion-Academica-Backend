<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleHorario extends Model
{
    protected $table = 'Detalle_Horario';
    protected $primaryKey = 'ID';
    public $timestamps = false;
    protected $fillable = ['Materia_ID', 'Grupo_ID', 'Aula_ID', 'Horario_ID'];
    public $incrementing = true;
    protected $keyType = 'int';

    public function materia()
    {
        return $this->belongsTo(Materia::class, 'Materia_ID', 'ID');
    }
    public function grupo()
    {
        return $this->belongsTo(Grupos::class, 'Grupo_ID', 'ID');
    }
    public function aula()
    {
        return $this->belongsTo(Aula::class, 'Aula_ID', 'ID');
    }
    public function horario()
    {
        return $this->belongsTo(Horarios::class, 'Horario_ID', 'ID');
    }
    public function detalleDocentes()
    {
        return $this->hasMany(DetalleDocente::class, 'ID_Detalle_Horario', 'ID');
    }
}
