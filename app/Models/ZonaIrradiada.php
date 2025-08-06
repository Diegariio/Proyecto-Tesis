<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZonaIrradiada extends Model
{
    protected $table = 'tron_zona_irradiada';
    protected $primaryKey = 'id_zona';
    public $incrementing = true;
    protected $fillable = ['nombre'];

    public function registrosTratamiento()
    {
    }
}
