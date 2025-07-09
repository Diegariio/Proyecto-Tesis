<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comuna extends Model
{
    protected $table = 'comuna';
    protected $primaryKey = 'id_comuna';
    protected $fillable = ['comuna'];

    public function pacientes()
    {
        return $this->hasMany(Paciente::class, 'id_comuna');
    }
}