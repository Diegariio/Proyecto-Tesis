<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GestionRequerimiento;
use App\Models\RegistroRequerimiento;
use App\Models\Gestion;

class RegistroTratamientoRadioterapiaSeeder extends Seeder
{
    public function run(): void
    {
        // Lista de ruts válidos (puedes usar los mismos que en tu otro seeder)
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
            '16.233.043-8'
        ];

        // Crea 15 registros, uno por cada id del 1 al 15
        for ($i = 1; $i <= 3; $i++) {
            RegistroTratamientoRadioterapia::create([
                'id_registro_tratamiento_radioterapia' => $i, // o simplemente 'id' si tu PK es 'id'
                'rut' => $ruts[array_rand($ruts)],
                'id_gestion' => rand(1, 15),

                // ... agrega aquí los demás campos requeridos por tu tabla ...
                // 'campo1' => valor,
                // 'campo2' => valor,
            ]);
        }
    }
}