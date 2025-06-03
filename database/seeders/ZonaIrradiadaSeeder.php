<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ZonaIrradiada;

class ZonaIrradiadaSeeder extends Seeder
{

    public function run(): void
    {
        $zonas = [
            'Encéfalo',
            'Columna cervical',
            'Cavidad oral',
            'Orofaringe',
            'Nasofaringe',
            'Laringe',
            'Hipofaringe',
            'Glándulas salivales',
            'Tiroides',
            'Mediastino',
            'Pulmones',
            'Mama izquierda',
            'Mama derecha',
            'Pared torácica',
            'Esófago',
            'Columna torácica',
            'Estómago',
            'Hígado',
            'Páncreas',
            'Bazo',
            'Colon',
            'Recto',
            'Vejiga',
            'Próstata',
            'Útero',
            'Cérvix (cuello uterino)',
            'Ovarios',
            'Testículos',
            'Región pélvica',
            'Nódulos linfáticos axilares',
            'Nódulos linfáticos cervicales',
            'Nódulos linfáticos inguinales',
            'Sacro',
            'Columna lumbar',
            'Extremidad superior derecha',
            'Extremidad superior izquierda',
            'Extremidad inferior derecha',
            'Extremidad inferior izquierda',
            'Sistema nervioso central',
            'Metástasis óseas localizadas',
        ];

        foreach ($zonas as $zona) {
            ZonaIrradiada::firstorCreate(['nombre' => $zona]);
        }
    }
}
