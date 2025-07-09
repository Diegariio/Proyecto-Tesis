<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EstadoProceso;

class EstadoProcesoSeeder extends Seeder
{
    public function run(): void
    {
        $estados = [
            'Sospecha',
            'Confirmación Diagnóstica',
            'Imágenes para Etapificación',
            'Comité Oncológico',
            'Tratamiento',
            'Seguimiento',
            'Alta',
            'Cuidados Paliativos'
        ];

        foreach ($estados as $estado) {
            EstadoProceso::firstOrCreate(['estado_proceso' => $estado]);
        }
    }
}
