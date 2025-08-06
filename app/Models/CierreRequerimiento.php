<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CierreRequerimiento extends Model
{
    protected $table = 'cierre_requerimiento';
    protected $primaryKey = 'id_cierre_requerimiento';
    protected $fillable = ['catalogo_cierre'];

    public function registros()
    {
        return $this->hasMany(RegistroRequerimiento::class, 'id_cierre_requerimiento');
    }
}
