<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear usuario administrador de prueba
        User::create([
            'name' => 'Administrador del Sistema',
            'email' => 'admin@test.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);

        // Crear usuarios adicionales de prueba
        User::create([
            'name' => 'Dr. Juan Pérez',
            'email' => 'doctor@test.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Enfermera María López',
            'email' => 'enfermera@test.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Radioterapeuta Carlos Ruiz',
            'email' => 'radioterapeuta@test.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);

        $this->command->info('✅ Usuarios de prueba creados:');
        $this->command->info('   - admin@test.com / password (Administrador)');
        $this->command->info('   - doctor@test.com / password (Doctor)');
        $this->command->info('   - enfermera@test.com / password (Enfermera)');
        $this->command->info('   - radioterapeuta@test.com / password (Radioterapeuta)');
    }
}