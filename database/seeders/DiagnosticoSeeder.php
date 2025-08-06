<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Diagnostico;

class DiagnosticoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $diagnosticos = [
            ['codigo' => 'C787', 'nombre' => 'Tumor maligno secundario del hìgado y de los conductos biliares intrahepaticos'],
            ['codigo' => 'C50.9', 'nombre' => 'Neoplasia maligna de mama, no especificada'],
            ['codigo' => 'C34.9', 'nombre' => 'Neoplasia maligna de bronquio o pulmón, no especificada'],
            ['codigo' => 'C61',   'nombre' => 'Neoplasia maligna de próstata'],
            ['codigo' => 'C20',   'nombre' => 'Neoplasia maligna de recto'],
            ['codigo' => 'C18.9', 'nombre' => 'Neoplasia maligna de colon, no especificada'],
            ['codigo' => 'C53.9', 'nombre' => 'Neoplasia maligna del cuello del útero, no especificada'],
            ['codigo' => 'C22.0', 'nombre' => 'Carcinoma hepatocelular'],
            ['codigo' => 'C71.9', 'nombre' => 'Neoplasia maligna del encéfalo, no especificada'],
            ['codigo' => 'C77.0', 'nombre' => 'Metástasis en ganglios linfáticos de cabeza, cara y cuello'],
            ['codigo' => 'C79.9', 'nombre' => 'Neoplasia maligna secundaria, sitio no especificado'],
        ];

        foreach ($diagnosticos as $data) {
            Diagnostico::firstOrCreate(
                ['codigo' => $data['codigo']],
                ['nombre' => $data['nombre']]
            );
        }
    }
}
