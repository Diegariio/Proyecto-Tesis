<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CodigoGES;

class CodigoGESSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $codigos = [
            'GES2902001', // Cáncer cervicouterino
            'GES2902005', // Cáncer gástrico
            '2902006', // Cáncer de próstata
            '2902007', // Cáncer de pulmón
            '2902008', // Leucemia en adultos
            '2902009', // Linfomas en adultos
        ];
        foreach ($codigos as $codigo) {
            CodigoGES ::firstorCreate(['codigo_ges' => $codigo]);
        }
        
    }
}
