<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CierreRequerimiento;

class CierreRequerimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cierres = [
            'SE REALIZA PROCEDIMIENTO',
            'CUENTA CON CITACIÓN',
            'SE REALIZA TRATAMIENTO',
            'SE REALIZA APORTE ECONOMICO',
            'SE ACTIVAN REDES DE APOYO',
            'SE REALIZA ATENCIÓN',
            'SE REALIZA COMPRA DE SERVICIO',
            'SE ENCUENTRA CONTACTO TELEFONICO',
            'SE CIERRA INTERCONSULTA',
            'SE INGRESA INTERCONSULTA',
            'SE REALIZA CIRUGIA',
            'SE REALIZA CORRECCION GARANTIA',
            'SE DERIVA A HOSPITAL BASE',
            'SE REALIZA EXAMEN',
            'SE REALIZA ETAPIFICACION',
            'SE REALIZA DIAGNOSTICO',
            'CUENTA CON PASE',
            'CUENTA CON RECETA',
            'SE HOSPITALIZA',
            'INGRESA A RESIDENCIA ONCOLÓGICA',
            'SE REALIZA TRASLADO URBANO',
            'SE REALIZA TRASLADO INTERURBANO',
            'SE PRESENTA A COMITÉ',
            'SE SUSPENDE TRATAMIENTO',
            'SE CONFIRMA DIAGNOSTICO',
            'SE DESCARTA DIAGNOSTICO',
            'SE REALIZA REUNION CLINICA',
            'SE REALIZA REUNION DE EQUIPO',
            'SE DETECTA RESOLUCION EN FICHA CLINICA',
            'FALLECIMIENTO',
            'RECHAZA ATENCIONES',
            '3 INASISTENCIA GES',
            '2 INASISTENCIA NO GES',
            'RECHAZA EXAMENES',
            'RETORNO A CESFAM'
        ];
        
        foreach ($cierres as $cierre) {
            CierreRequerimiento::firstOrCreate(['catalogo_cierre' => $cierre]);
        }
        
    }
}
