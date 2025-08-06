<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Respuesta;

class RespuestaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $catalogos = [
            'NO HAY RESPUESTA POR CORREO',
            'SI HAY RESPUESTA POR CORREO',
            'SI HAY RESPUESTA TELEFONICA',
            'SU HAY RESPUESTA PRESENCIAL',
            'PACIENTE QUEDA CONFORME',
            'PACIENTE RECHAZA ATENCIONES',
            'NO HAY HORAS DISPONIBLES',
            'PACIENTE DEBE PEDIR HORA PRESENCIAL',
            'PACIENTE DEBE PEDIR HORA TELEFONICAMENTE',
            'ESPERAR QUE TERMINE PROCEDIMIENTO',
            'ESPERAR QUE TERMINE EXAMENES',
            'ESPERAR QUE SEA PRESENTADO A COMITE',
            'ESPERAR QUE TERMINE TRATAMIENTO',
            'ESPERAR RESPUESTA'
        ];
        
        foreach ($catalogos as $catalogo) {
            Respuesta::firstOrCreate(['catalogo_respuestas' => $catalogo]);
        }
    }
}
