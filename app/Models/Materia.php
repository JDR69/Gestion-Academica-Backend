<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    protected $table = 'Materia';
    protected $primaryKey = 'ID';
    public $timestamps = false;
    protected $fillable = ['Nombre'];
    public $incrementing = true;
    protected $keyType = 'int';

    public function detalleHorarios()
    {
        return $this->hasMany(DetalleHorario::class, 'Materia_ID', 'ID');
    }
}
