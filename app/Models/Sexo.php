<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sexo extends Model
{
    protected $table = 'sexo';
    protected $primaryKey = 'id_sexo';
    protected $fillable = ['sexo'];

    public function pacientes()
    {
        return $this->hasMany(Paciente::class, 'id_sexo');
    }
}

