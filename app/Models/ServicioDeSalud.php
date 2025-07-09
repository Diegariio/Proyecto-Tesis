<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicioDeSalud extends Model
{
    protected $table = 'servicio_de_salud';
    protected $primaryKey = 'id_servicio';
    protected $fillable = ['servicio_de_salud'];

    public function pacientes()
    {
        return $this->hasMany(Paciente::class, 'id_servicio');
    }
}
