<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requerimiento extends Model
{
    protected $table = 'requerimiento';
    protected $primaryKey = 'id_requerimiento';
    protected $fillable = ['requerimiento', 'id_entidad', 'id_emisor', 'id_registro_requerimiento'];

    public function entidad()
    {
        return $this->belongsTo(EntidadQueResuelve::class, 'id_entidad');
    }

    public function emisor()
    {
        return $this->belongsTo(EmisorRequerimiento::class, 'id_emisor');
    }

    public function registro()
    {
        return $this->belongsTo(RegistroRequerimiento::class, 'id_registro_requerimiento');
    }
}

