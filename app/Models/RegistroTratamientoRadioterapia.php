<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Radioterapeuta;
use App\Models\Paciente;
use App\Models\DefinicionEquipo;
use App\Models\DiaRealizado;
use App\Models\CodigoGES;
use App\Models\CodigoTratamiento;
use App\Models\ZonaIrradiada;
use App\Models\QuimioterapiaConcominante;
use App\Models\CodigoCie10;

class RegistroTratamientoRadioterapia extends Model
{
    protected $table = 'tron_registro_tratamiento';
    protected $primaryKey = 'id_registro_tratamiento';
    public $incrementing = true;
    protected $fillable = [
        'id_radioterapeuta',
        'rut',
        'id_codigo_ges',
        'id_codigo_tratamiento',
        'id_zona',
        'id_quimioterapia_concominante',
        'id_codigo',
        'n_sesiones_programadas',
        'intencion',
        'fecha_inicio',
        'fecha_termino',
        'fecha_simulacion_tratamiento',
        'fecha_indicacion',
        'cobertura_ges',
        'horario_tratamiento',
        'observaciones',
    ];

    // Relación: Un registro pertenece a un radioterapeuta
    public function radioterapeuta()
    {
        return $this->belongsTo(Radioterapeuta::class, 'id_radioterapeuta');
    }

    // Relación: Un registro pertenece a un paciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'rut', 'rut');
    }

    // Relación: Un registro tiene muchas definiciones de equipo
    public function definicionesEquipo()
    {
        return $this->hasMany(DefinicionEquipo::class, 'id_registro_tratamiento');
    }

    // Relación: Un registro tiene muchos días realizados
    public function diasRealizados()
    {
        return $this->hasMany(DiaRealizado::class, 'id_registro_tratamiento');
    }

    // Relación: Un registro pertenece a un código GES
    public function codigoGes()
    {
        return $this->belongsTo(CodigoGES::class, 'id_codigo_ges');
    }

    // Relación: Un registro pertenece a un código de tratamiento
    public function codigoTratamiento()
    {
        return $this->belongsTo(CodigoTratamiento::class, 'id_codigo_tratamiento');
    }

    // Relación: Un registro pertenece a una zona irradiada
    public function zonaIrradiada()
    {
        return $this->belongsTo(ZonaIrradiada::class, 'id_zona', 'id_zona');
    }

    // Relación: Un registro pertenece a un tipo de quimioterapia
    public function quimioterapia()
    {
        return $this->belongsTo(QuimioterapiaConcominante::class, 'id_quimioterapia_concominante', 'id_quimioterapia_concominante');
    }

    // Relación: Un registro pertenece a un código CIE-10
    public function codigoCie10()
    {
        return $this->belongsTo(CodigoCie10::class, 'id_codigo', 'id_codigo');
    }
}
