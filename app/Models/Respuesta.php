<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    protected $table = 'respuestas';
    protected $primaryKey = 'id_respuesta';
    protected $fillable = ['catalogo_respuestas'];

    public function respuestas()
    {
        return $this->hasMany(GestionRequerimiento::class, 'id_respuesta');
    }
}
