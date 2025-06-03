<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\RegistroTratamientoRadioterapia;

class Diagnostico extends Model
{
    protected $table = 'tron_diagnostico';
    protected $primaryKey = 'id_diagnostico';
    public $incrementing = true;
    protected $fillable = ['codigo', 'nombre'];

    public function registrosTratamiento()
    {
        return $this->hasMany(RegistroTratamientoRadioterapia::class, 'id_diagnostico');
    }
}
