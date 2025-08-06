<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\RegistroTratamientoRadioterapia;

class DiaRealizado extends Model
{
    protected $table = 'tron_dia_realizado';
    protected $primaryKey = 'id_dia_realizado';
    public $incrementing = true;
    
    protected $fillable = [
        'id_registro_tratamiento',
        'se_realizo',
        'fecha_registro'
    ];

    protected $casts = [
        'se_realizo' => 'boolean',
        'fecha_registro' => 'date'
    ];

    // Relación: Un día realizado pertenece a un registro de tratamiento
    public function registroTratamiento()
    {
        return $this->belongsTo(RegistroTratamientoRadioterapia::class, 'id_registro_tratamiento');
    }
}
