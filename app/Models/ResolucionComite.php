<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResolucionComite extends Model
{
    protected $table = 'resolucion_comite';
    protected $primaryKey = 'id_resolucion_comite';
    protected $fillable = ['resolucion_comite'];

    public function tiene()
    {
        return $this->belongsTo(Tiene::class, 'id_tiene');
    }
}
