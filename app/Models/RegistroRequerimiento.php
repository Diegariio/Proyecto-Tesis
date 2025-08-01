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
        'id_gestion',
        'rut',
        'id_categoria',
        'id_responsable',
        'id_entidad',
        'id_emisor',
        'fecha',
        'resolucion_comite',
        'fecha_proxima_revision',
        'resolucion_caso',
        'fecha_gestion',
        'respuesta',
        'observaciones',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'rut', 'rut');
    }

    public function codigo()
    {
        return $this->belongsTo(CodigoCie10::class, 'id_codigo');
    }

    public function gestion()
    {
        return $this->belongsTo(Gestion::class, 'id_gestion');
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
}
