<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    protected $table = 'Asistencia';
    protected $primaryKey = 'ID';
    public $timestamps = false;
    protected $fillable = ['Descripcion'];
    public $incrementing = true;
    protected $keyType = 'int';

    public function detalleDocentes()
    {
        return $this->hasMany(DetalleDocente::class, 'ID_Asistencia', 'ID');
    }
}
