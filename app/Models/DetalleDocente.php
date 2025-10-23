<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleDocente extends Model
{
    protected $table = 'Detalle_Docente';
    protected $primaryKey = 'ID';
    public $timestamps = false;
    protected $fillable = ['ID_Docente', 'ID_Asistencia', 'ID_Detalle_Horario'];
    public $incrementing = true;
    protected $keyType = 'int';

    public function docente()
    {
        return $this->belongsTo(Docente::class, 'ID_Docente', 'ID');
    }
    public function asistencia()
    {
        return $this->belongsTo(Asistencia::class, 'ID_Asistencia', 'ID');
    }
    public function detalleHorario()
    {
        return $this->belongsTo(DetalleHorario::class, 'ID_Detalle_Horario', 'ID');
    }
}
