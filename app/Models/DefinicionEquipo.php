<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\RegistroTratamientoRadioterapia;
use App\Models\EquipoTratamiento;

class DefinicionEquipo extends Model
{
    protected $table = 'tron_definicion_equipo';
    protected $primaryKey = 'id_definicion';
    public $incrementing = true;
    
    protected $fillable = [
        'id_registro_tratamiento',
        'id_equipo',
        'fecha_comite'
    ];

    // Relación: Una definición pertenece a un registro de tratamiento
    public function registroTratamiento()
    {
        return $this->belongsTo(RegistroTratamientoRadioterapia::class, 'id_registro_tratamiento');
    }

    // Relación: Una definición pertenece a un equipo de tratamiento
    public function equipoTratamiento()
    {
        return $this->belongsTo(EquipoTratamiento::class, 'id_equipo');
    }
}
