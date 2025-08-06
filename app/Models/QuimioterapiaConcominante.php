<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuimioterapiaConcominante extends Model
{
    protected $table = 'tron_quimioterapia_concominante';
    protected $primaryKey = 'id_quimioterapia_concominante';
    public $incrementing = true;
    protected $fillable = ['nombre'];

    public function registrosTratamiento()
    {
    }
}
