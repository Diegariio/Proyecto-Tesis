<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\QuimioterapiaConcominante;

class QuimioterapiaConcominanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nombres = [
            'si',
            'no', 
            'temozolomida', 
            'capecitabina', 
        ];
        foreach ($nombres as $nombre) {
            QuimioterapiaConcominante ::firstorCreate(['nombre' => $nombre]);
        }
    }
}
