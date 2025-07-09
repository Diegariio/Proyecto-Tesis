<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoProceso extends Model
{
    protected $table = 'estado_proceso';
    protected $primaryKey = 'id_estado_proceso';
    protected $fillable = ['estado_proceso'];

    public function tiene()
    {
        return $this->hasMany(Tiene::class, 'id_estado_proceso');
    }
}

