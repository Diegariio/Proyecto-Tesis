<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requerimiento extends Model
{
    protected $table = 'requerimiento';
    protected $primaryKey = 'id_requerimiento';
    protected $fillable = ['requerimiento', 'id_registro_requerimiento'];



    public function registro()
    {
        return $this->belongsTo(RegistroRequerimiento::class, 'id_registro_requerimiento');
    }
}

