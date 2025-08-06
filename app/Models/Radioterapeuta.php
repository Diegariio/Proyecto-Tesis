<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\RegistroTratamientoRadioterapia;

class Radioterapeuta extends Model
{
    protected $table = 'tron_radioterapeuta';
    protected $primaryKey = 'id_radioterapeuta';
    public $incrementing = true;
    protected $fillable = ['nombre'];

    // Relación: Un radioterapeuta tiene muchos registros de tratamiento
    public function registrosTratamiento()
    {
        return $this->hasMany(RegistroTratamientoRadioterapia::class, 'id_radioterapeuta');
    }
}
