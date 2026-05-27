<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Menu::create([
            'nama_menu' => 'Paket Menu 1',
            'harga' => '30000',
            'deskripsi' => 'Chicken Katsu + Es Teh',
            'is_available' => true,
        ]);

        Menu::create([
            'nama_menu' => 'Black Coffee',
            'harga' => '10000',
            'deskripsi' => 'Ukuran Large',
            'is_available' => true,
        ]);
    }
}
