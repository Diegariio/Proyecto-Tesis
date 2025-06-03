<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\RegistroTratamientoRadioterapia;

class EquipoTratamiento extends Model
{
    protected $table = 'tron_equipo_tratamiento';
    protected $primaryKey = 'id_equipo';
    public $incrementing = true;
    protected $fillable = ['nombre'];

    public function registrosTratamiento()
    {
        return $this->hasMany(RegistroTratamientoRadioterapia::class, 'id_equipo');
    }
}
