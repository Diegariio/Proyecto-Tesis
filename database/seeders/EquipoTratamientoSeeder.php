<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EquipoTratamiento;

class EquipoTratamientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nombres = [
            'Unique',
            'Halcyon CCP',
            'Halcyon THNO',
        ];

        foreach ($nombres as $nombre) {
            EquipoTratamiento::firstorCreate(['nombre' => $nombre]);
        }
    }
}
