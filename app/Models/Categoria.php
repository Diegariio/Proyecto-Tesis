<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categoria';
    protected $primaryKey = 'id_categoria';
    protected $fillable = ['tipo_categoria'];

    public function registros()
    {
        return $this->hasMany(RegistroRequerimiento::class, 'id_categoria');
    }
}
