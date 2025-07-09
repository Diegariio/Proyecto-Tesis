<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tiene;

class TieneSeeder extends Seeder
{
    public function run(): void
    {
        $ruts = [
            '00112233-6', '00223344-8', '11223344-5', '11334455-9', '12345678-9',
            '22334455-7', '22445566-0', '33445566-K', '33556677-K', '44556677-8',
            '44667788-1', '55667788-0', '55778899-2', '66778899-1', '77889900-2',
            '77990011-5', '88990011-4', '98765432-1', '99001122-7', '99887766-3'
        ];

        foreach ($ruts as $rut) {
            Tiene::firstOrCreate([
                'rut' => $rut,
                'id_codigo' => rand(1, 10),
                'id_estado_proceso' => rand(1, 8),
            ]);
        }
    }
}
