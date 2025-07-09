<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServicioDeSalud;

class ServicioDeSaludSeeder extends Seeder
{
    public function run(): void
    {
        $servicios = [
            'Aconcagua', 'Aisen', 'Antofagasta', 'Araucania Norte', 'Araucania Sur', 'Arauco', 'Arica',
            'Atacama', 'Biobio', 'Chiloe', 'Concepcion', 'Coquimbo', 'Iquique', 'Magallanes', 'Maule',
            'Metropolitano Central', 'Metropolitano Norte', 'Metropolitano Occidente',
            'Metropolitano Oriente', 'Metropolitano Sur', 'Metropolitano Sur-Oriente', 'Ñuble',
            'O’higgins', 'Osorno', 'Reloncavi', 'Talcahuano', 'Valdivia', 'Valparaiso – San Antonio',
            'Viña Del Mar – Quillota'
        ];

        foreach ($servicios as $nombre) {
            ServicioDeSalud::firstOrCreate(['servicio_de_salud' => $nombre]);
        }
    }
}
