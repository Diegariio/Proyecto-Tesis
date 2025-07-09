<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CodigoCie10 extends Model
{
    protected $table = 'codigo_cie10';
    protected $primaryKey = 'id_codigo';
    protected $fillable = ['codigo_cie10', 'descripcion'];

    public function tiene()
    {
        return $this->hasMany(Tiene::class, 'id_codigo');
    }
}

