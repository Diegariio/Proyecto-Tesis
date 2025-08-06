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
use Database\Seeders\QuimioterapiaConcominanteSeeder;
use Database\Seeders\ComunaSeeder;
use Database\Seeders\RespuestaSeeder;
use Database\Seeders\GestionRequerimientoSeeder;
use Database\Seeders\CierreRequerimientoSeeder;
use Database\Seeders\ResolucionComiteSeeder;

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
        QuimioterapiaConcominanteSeeder::class,
        ComunaSeeder::class,
        SexoSeeder::class,
        ServicioDeSaludSeeder::class,
        PacienteSeeder::class,
        CodigoCie10Seeder::class,
        EstadoProcesoSeeder::class,
        TieneSeeder::class,
        GestionSeeder::class,
        CategoriaSeeder::class,
        ResponsableSeeder::class,
        EntidadQueResuelveSeeder::class,
        EmisorRequerimientoSeeder::class,
        CierreRequerimientoSeeder::class,
        RegistroRequerimientoSeeder::class,
        RequerimientoSeeder::class,
        GestionRequerimientoSeeder::class,
        RespuestaSeeder::class,
        ResolucionComiteSeeder::class,
        ]);
    }
}
