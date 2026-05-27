<?php

namespace Database\Seeders;

use App\Models\Meja;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MejaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Meja::factory()->count(10)->create();
        
        // Meja::create([
        //     'nomor_meja' => '1',
        // ]);
    }
}
