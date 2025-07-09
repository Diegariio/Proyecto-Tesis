<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            '2do Prestador/Compra',
            'Comite',
            'Gestion',
            'Movilizacion',
            'Oncorad',
            'Reembolso',
            'Residencia',
        ];

        foreach ($categorias as $tipo) {
            Categoria::firstOrCreate(['tipo_categoria' => $tipo]);
        }
    }
}
