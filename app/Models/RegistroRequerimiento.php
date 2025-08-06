<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistroRequerimiento extends Model
{
    protected $table = 'registro_requerimiento';
    protected $primaryKey = 'id_registro_requerimiento';
    protected $fillable = [
        'id_requerimiento',
        'id_codigo',
        'rut',
        'id_categoria',
        'id_responsable',
        'id_entidad',
        'id_emisor',
        'id_cierre_requerimiento',
        'fecha',
        'fecha_proxima_revision',
        'observaciones',
        'estado', // nuevo campo
    ];

    // Estado calculado dinámicamente
    public function getEstadoActualAttribute()
    {
        if ($this->id_cierre_requerimiento) {
            return 'cerrado';
        }
        if ($this->gestiones()->count() > 0) {
            return 'gestiones en curso';
        }
        return 'sin gestiones';
    }

    // Relación con gestiones
    public function gestiones()
    {
        return $this->hasMany(\App\Models\GestionRequerimiento::class, 'id_registro_requerimiento');
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'rut', 'rut');
    }

    public function codigo()
    {
        return $this->belongsTo(CodigoCie10::class, 'id_codigo');
    }


    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    public function responsable()
    {
        return $this->belongsTo(Responsable::class, 'id_responsable');
    }

    public function entidad()
    {
        return $this->belongsTo(EntidadQueResuelve::class, 'id_entidad');
    }

    public function emisor()
    {
        return $this->belongsTo(EmisorRequerimiento::class, 'id_emisor');
    }

    public function requerimientos()
    {
        return $this->hasMany(Requerimiento::class, 'id_registro_requerimiento');
    }

    public function requerimiento()
{
    return $this->belongsTo(Requerimiento::class, 'id_requerimiento');
}
    public function cierre()
    {
        return $this->belongsTo(CierreRequerimiento::class, 'id_cierre_requerimiento');
    }
}
