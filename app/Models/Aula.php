<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    protected $table = 'Aula';
    protected $primaryKey = 'ID';
    public $timestamps = false;
    protected $fillable = ['Nro_Facultad', 'Nro_Aula'];
    public $incrementing = true;
    protected $keyType = 'int';

    public function detalleHorarios()
    {
        return $this->hasMany(DetalleHorario::class, 'Aula_ID', 'ID');
    }
}
