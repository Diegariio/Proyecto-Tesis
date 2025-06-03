<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\RegistroTratamientoRadioterapia;

class CodigoTratamiento extends Model
{
    protected $table = 'tron_codigo_tratamiento';
    protected $primaryKey = 'id_codigo_tratamiento';
    public $incrementing = true;
    protected $fillable = ['codigo'];

    public function registrosTratamiento()
    {
        return $this->hasMany(RegistroTratamientoRadioterapia::class, 'id_codigo_tratamiento');
    }
}
