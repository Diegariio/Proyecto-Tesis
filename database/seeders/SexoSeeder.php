<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sexo;

class SexoSeeder extends Seeder
{
    public function run(): void
    {
        $sexos = ['Hombre', 'Indeterminado', 'Mujer'];

        foreach ($sexos as $nombre) {
            Sexo::firstOrCreate(['sexo' => $nombre]);
        }
    }
}