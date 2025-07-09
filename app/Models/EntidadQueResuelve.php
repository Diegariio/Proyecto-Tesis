<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntidadQueResuelve extends Model
{
    protected $table = 'entidad_que_resuelve';
    protected $primaryKey = 'id_entidad';
    protected $fillable = ['catalogo'];

    public function requerimientos()
    {
        return $this->hasMany(Requerimiento::class, 'id_entidad');
    }
}

