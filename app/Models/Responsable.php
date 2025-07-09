<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Responsable extends Model
{
    protected $table = 'responsable';
    protected $primaryKey = 'id_responsable';
    protected $fillable = ['responsable'];

    public function registros()
    {
        return $this->hasMany(RegistroRequerimiento::class, 'id_responsable');
    }
}

