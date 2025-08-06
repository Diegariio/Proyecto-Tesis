<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\RegistroTratamientoRadioterapia;

class Paciente extends Model
{
    protected $table = 'paciente';
    protected $primaryKey = 'rut';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['rut', 'nombre', 'primer_apellido', 'segundo_apellido', 'id_comuna', 'id_sexo', 'id_servicio'];

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

    // Relación: Un paciente tiene muchos registros de tratamiento
    public function registrosTratamiento()
    {
        return $this->hasMany(RegistroTratamientoRadioterapia::class, 'rut', 'rut');
    }
}

