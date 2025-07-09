<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Responsable;

class ResponsableSeeder extends Seeder
{
    public function run(): void
    {
        $responsables = [
            'Alondra Montes',
            'Brenda Bilczuk',
            'Camila Fuentes',
            'Camila Neira',
            'Jazmina Villarroel',
            'Josefa Muñoz',
            'Monserrat Gutierrez',
            'Nayaret Danilla',
            'Patricia Gutierrez',
            'Rossana Quintana',
            'Solange Arratia',
            'Paulina Bustamante',
        ];

        foreach ($responsables as $nombre) {
            Responsable::firstOrCreate(['responsable' => $nombre]);
        }
    }
}
