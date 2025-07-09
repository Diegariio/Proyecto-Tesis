<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gestion extends Model
{
    protected $table = 'gestion';
    protected $primaryKey = 'id_gestion';
    protected $fillable = ['gestion'];

    public function registros()
    {
        return $this->hasMany(RegistroRequerimiento::class, 'id_gestion');
    }
}
