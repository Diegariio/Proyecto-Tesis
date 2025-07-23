<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RegistroRequerimiento;

class RegistroRequerimientoSeeder extends Seeder
{
    public function run(): void
    {
        $ruts = [
            '00.112.233-6',
            '00.223.344-8',
            '11.223.344-5',
            '11.334.455-9',
            '12.345.678-9',
            '22.334.455-7',
            '22.445.566-0',
            '33.445.566-K',
            '33.556.677-K',
            '44.556.677-8',
            '44.667.788-1',
            '55.667.788-0',
            '55.778.899-2',
            '66.778.899-1',
            '77.889.900-2',
            '77.990.011-5',
            '88.990.011-4',
            '98.765.432-1',
            '99.001.122-7',
            '99.887.766-3'
        ];
        

        for ($i = 1; $i <= 106; $i++) {
            RegistroRequerimiento::create([
                'id_requerimiento'               => rand(1, 10),
                'id_codigo'               => rand(1, 10),
                'id_gestion'              => rand(1, 15),
                'rut'                     => $ruts[array_rand($ruts)],
                'id_categoria'            => rand(1, 7),
                'id_responsable'          => rand(1, 12),
                'fecha'                   => now()->format('Y-m-d'),
                'resolucion_comite'       => null,
                'fecha_proxima_revision'  => null,
                'resolucion_caso'         => null,
                'fecha_gestion'           => null,
                'respuesta'               => null,
            ]);
        }
    }
}

