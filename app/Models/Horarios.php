<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horarios extends Model
{
    protected $table = 'Horarios';
    protected $primaryKey = 'ID';
    public $timestamps = false;
    protected $fillable = ['Hora_Inicio', 'Hora_Fin'];
    public $incrementing = true;
    protected $keyType = 'int';

    public function detalleHorarios()
    {
        return $this->hasMany(DetalleHorario::class, 'Horario_ID', 'ID');
    }
}
