<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmisorRequerimiento extends Model
{
    protected $table = 'emisor_requerimiento';
    protected $primaryKey = 'id_emisor';
    protected $fillable = ['catalogo'];

    public function requerimientos()
    {
        return $this->hasMany(Requerimiento::class, 'id_emisor');
    }
}

