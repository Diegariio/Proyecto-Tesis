<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Radioterapeuta;

class RadioterapeutaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nombres = [
            'María González',
            'Carlos Ramírez',
            'Sofía Herrera',
            'Andrés Soto',
            'Camila Torres',
            'Javier Morales',
            'Paula Fernández',
            'Diego Rivas',
            'Valentina Paredes',
            'Felipe Castro',
            'Isidora Núñez',
            'Ignacio Vidal',
            'Fernanda Salinas',
            'Tomás Araya',
            'Daniela Fuentes',
            'Ricardo Palma',
            'Antonia Navarro',
            'Cristóbal Leiva',
        ];

        foreach ($nombres as $nombre) {
            Radioterapeuta::firstOrCreate(['nombre' => $nombre]);
        }
    }
}
