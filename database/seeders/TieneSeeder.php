<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tiene;

class TieneSeeder extends Seeder
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

        foreach ($ruts as $index => $rut) {
            Tiene::create([
                'rut' => $rut,
                'id_codigo' => rand(1, 10), // Código CIE10 aleatorio
                'id_estado_proceso' => rand(1, 5), // Estado aleatorio
            ]);
        }
    }
}
