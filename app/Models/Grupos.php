<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grupos extends Model
{
    protected $table = 'Grupos';
    protected $primaryKey = 'ID';
    public $timestamps = false;
    protected $fillable = ['Nombre'];
    public $incrementing = true;
    protected $keyType = 'int';

    public function detalleHorarios()
    {
        return $this->hasMany(DetalleHorario::class, 'Grupo_ID', 'ID');
    }
}
