<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $table = 'paciente';
    protected $primaryKey = 'rut';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['rut', 'nombre', 'apellidos', 'id_comuna', 'id_sexo', 'id_servicio'];

    public function comuna()
    {
        return $this->belongsTo(Comuna::class, 'id_comuna');
    }

    public function sexo()
    {
        return $this->belongsTo(Sexo::class, 'id_sexo');
    }

    public function servicio()
    {
        return $this->belongsTo(ServicioDeSalud::class, 'id_servicio');
    }
}

