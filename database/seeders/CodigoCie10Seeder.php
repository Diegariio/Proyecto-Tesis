<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CodigoCie10;

class CodigoCie10Seeder extends Seeder
{
    public function run(): void
    {
        $codigos = [
            ['codigo_cie10' => 'C50', 'descripcion' => 'Tumor maligno de la mama'],
            ['codigo_cie10' => 'C78', 'descripcion' => 'Tumor maligno secundario de los órganos respiratorios y digestivos'],
            ['codigo_cie10' => 'C80', 'descripcion' => 'Tumor maligno de sitio no especificado'],
            ['codigo_cie10' => 'C25', 'descripcion' => 'Tumor maligno del páncreas'],
            ['codigo_cie10' => 'C16', 'descripcion' => 'Tumor maligno del estómago'],
            ['codigo_cie10' => 'C34', 'descripcion' => 'Tumor maligno de los bronquios y del pulmón'],
            ['codigo_cie10' => 'C53', 'descripcion' => 'Tumor maligno del cuello del útero'],
            ['codigo_cie10' => 'C20', 'descripcion' => 'Tumor maligno del recto'],
            ['codigo_cie10' => 'C18', 'descripcion' => 'Tumor maligno del colon'],
            ['codigo_cie10' => 'C61', 'descripcion' => 'Tumor maligno de la próstata']
        ];

        foreach ($codigos as $codigo) {
            CodigoCie10::updateOrCreate(
                ['codigo_cie10' => $codigo['codigo_cie10']],
                [
                    'descripcion' => $codigo['descripcion']
                ]
            );
        }
    }
}