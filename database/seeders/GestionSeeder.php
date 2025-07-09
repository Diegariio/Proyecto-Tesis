<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gestion;

class GestionSeeder extends Seeder
{
    public function run(): void
    {
        $gestiones = [
            'Conversado con enfermera',
            'Conversado con matrona',
            'Conversado con medico',
            'Conversado con tecnologo medico',
            'Conversado con tens',
            'Correo a jefatura',
            'Envia correo',
            'Pasa a braquiterapia',
            'Reitera correo',
            'Se educa a paciente',
            'Se informa a paciente',
            'Se llama a paciente para consultar caso',
            'Se realiza documentos residencia',
            'Se realiza seguimiento',
            'Se revisa ficha clinica',
        ];

        foreach ($gestiones as $gestion) {
            Gestion::firstOrCreate(['gestion' => $gestion]);
        }
    }
}
