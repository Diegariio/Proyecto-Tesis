<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tiene extends Model
{
    protected $table = 'tiene';
    protected $primaryKey = 'id_tiene';
    protected $fillable = ['rut', 'id_codigo', 'id_estado_proceso'];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'rut');
    }

    public function codigo()
    {
        return $this->belongsTo(CodigoCie10::class, 'id_codigo');
    }

    public function estadoProceso()
    {
        return $this->belongsTo(EstadoProceso::class, 'id_estado_proceso');
    }
}

