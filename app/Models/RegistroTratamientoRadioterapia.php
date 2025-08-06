<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Diagnostico;
use App\Models\ZonaIrradiada;
use App\Models\EquipoTratamiento;
use App\Models\Radioterapeuta;
use App\Models\CodigoTratamiento;
use App\Models\CodigoGES;
use App\Models\QuimioterapiaConcominante;

class RegistroTratamientoRadioterapia extends Model
{
    protected $table = 'tron_registro_tratamiento';
    protected $primaryKey = 'id_registro_tratamiento';
    public $incrementing = true;
    protected $fillable = [
        'id_diagnostico',
        'id_zona',
        'id_equipo',
        'id_radioterapeuta',
        'id_codigo_tratamiento',
        'id_codigo_ges',
        'id_quimioterapia_concominante',
        'tipo_atencion',
        'n_sesiones_programadas',
        'n_sesiones_realizadas',
        'intencion',
        'fecha_indicacion',
        'fecha_comite',
        'fecha_simulacion',
        'fecha_inicio',
        'fecha_termino',
        'cobertura_ges',
        'horario',
        'tipo_tratamiento',
        'observaciones',
    ];

    public function diagnostico()
    {
        return $this->belongsTo(Diagnostico::class, 'id_diagnostico');
    }

    public function zonaIrradiada()
    {
        return $this->belongsTo(ZonaIrradiada::class, 'id_zona');
    }

    public function equipoTratamiento()
    {
        return $this->belongsTo(EquipoTratamiento::class, 'id_equipo');
    }
    public function quimioterapiaConcominante()
    {
        return $this->belongsTo(QuimioterapiaConcominante::class, 'id_quimioterapia_concominante');
    }
    public function radioterapeuta()
    {
        return $this->belongsTo(Radioterapeuta::class, 'id_radioterapeuta');
    }

    public function codigoTratamiento()
    {
        return $this->belongsTo(CodigoTratamiento::class, 'id_codigo_tratamiento');
    }

    public function codigoGES()
    {
        return $this->belongsTo(CodigoGES::class, 'id_codigo_ges');
    }
}
