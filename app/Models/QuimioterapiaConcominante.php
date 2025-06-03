<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\RegistroTratamientoRadioterapia;

class QuimioterapiaConcominante extends Model
{
    protected $table = 'tron_quimioterapia_concominante';
    protected $primaryKey = 'id_quimioterapia_concominante';
    public $incrementing = true;
    protected $fillable = ['nombre'];

    public function registrosTratamiento()
    {
        return $this->hasMany(RegistroTratamientoRadioterapia::class, 'id_quimioterapia');
    }
}
