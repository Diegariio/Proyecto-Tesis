<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GestionRequerimiento extends Model
{
    protected $table = 'gestion_requerimiento';
    protected $primaryKey = 'id_gestion_requerimiento';
    
    protected $fillable = [
        'id_registro_requerimiento',
        'id_gestion',
        'id_respuesta',
        'estado_gestion',
        'fecha_gestion',
        'respuesta'
    ];
    
    protected $casts = [
        'fecha_gestion' => 'date'
    ];
    
    // Relaciones
    public function registroRequerimiento()
    {
        return $this->belongsTo(RegistroRequerimiento::class, 'id_registro_requerimiento');
    }
    
    public function gestion()
    {
        return $this->belongsTo(Gestion::class, 'id_gestion');
    }

    public function respuesta()
    {
        return $this->belongsTo(Respuesta::class, 'id_respuesta');
    }
}
