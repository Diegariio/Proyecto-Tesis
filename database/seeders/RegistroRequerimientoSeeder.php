<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RegistroRequerimiento;

class RegistroRequerimientoSeeder extends Seeder
{
    public function run(): void
    {
        $ruts = [
            '00112233-6','00223344-8','11223344-5','11334455-9','12345678-9',
            '22334455-7','22445566-0','33445566-K','33556677-K','44556677-8',
            '44667788-1','55667788-0','55778899-2','66778899-1','77889900-2',
            '77990011-5','88990011-4','98765432-1','99001122-7','99887766-3'
        ];

        for ($i = 1; $i <= 106; $i++) {
            RegistroRequerimiento::create([
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

