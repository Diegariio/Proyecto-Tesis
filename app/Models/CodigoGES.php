<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\RegistroTratamientoRadioterapia;

class CodigoGES extends Model
{
    protected $table = 'tron_codigo_ges';
    protected $primaryKey = 'id_codigo_ges';
    public $incrementing = true;
    protected $fillable = ['codigo_ges'];

    public function registrosTratamiento()
    {
        return $this->hasMany(RegistroTratamientoRadioterapia::class, 'id_codigo_ges');
    }
}
