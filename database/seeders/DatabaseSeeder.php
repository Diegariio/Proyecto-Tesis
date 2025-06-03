<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\ZonaIrradiadaSeeder;
use Database\Seeders\CodigoTratamientoSeeder;
use Database\Seeders\EquipoTratamientoSeeder;
use Database\Seeders\RadioterapeutaSeeder;
use Database\Seeders\CodigoGESSeeder;
use Database\Seeders\DiagnosticoSeeder;
use Database\Seeders\QuimioterapiaConcominanteSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call([
        ZonaIrradiadaSeeder::class,
        CodigoTratamientoSeeder::class,
        EquipoTratamientoSeeder::class,
        RadioterapeutaSeeder::class,
        CodigoGESSeeder::class,
        DiagnosticoSeeder::class,
        QuimioterapiaConcominanteSeeder::class,
        ]);
    }
}
