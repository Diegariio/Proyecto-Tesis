<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RegistroRequerimiento;

class RegistroRequerimientoSeeder extends Seeder
{
    public function run(): void
    {
        $ruts = [
            '7.901.833-3',
            '6.712.280-1',
            '26.606.887-5',
            '7.762.628-K',
            '18.342.068-2',
            '15.063.707-4',
            '2.780.792-5',
            '30.801.956-K',
            '34.865.257-5',
            '14.815.545-3',
            '25.541.515-8',
            '26.335.658-6',
            '15.517.731-4',
            '25.548.374-9',
            '16.233.043-8',
            '4.613.253-K',
            '11.981.401-4',
            '25.287.934-K',
            '1.649.584-0',
            '12.328.543-3',
            '21.012.009-2'
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

