<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DefinicionEquipo;

class EquipoTratamiento extends Model
{
    protected $table = 'tron_equipo_tratamiento';
    protected $primaryKey = 'id_equipo';
    public $incrementing = true;
    protected $fillable = ['nombre'];

    // Relación: Un equipo puede estar en muchas definiciones
    public function definicionesEquipo()
    {
        return $this->hasMany(DefinicionEquipo::class, 'id_equipo');
    }
}
