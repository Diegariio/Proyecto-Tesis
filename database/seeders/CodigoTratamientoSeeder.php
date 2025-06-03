<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CodigoTratamiento;

class CodigoTratamientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $codigos = [
            '2902006',
            '2902005',
            '2902007',
            '2902008',
            '2902001',
            '2902003',
        ];

        foreach ($codigos as $codigo) {
            CodigoTratamiento::firstorCreate(['codigo' => $codigo]);
        }
    }
}
