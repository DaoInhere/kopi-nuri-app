<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Membuat Akun Kasir
        User::create([
            'name' => 'Akun Kasir',
            'email' => 'kasir@kopinuri.com',
            'password' => Hash::make('password123'), // Password disamakan agar mudah diingat
            'role' => 'kasir',
        ]);

        // 2. Membuat Akun Owner
        User::create([
            'name' => 'Akun Owner',
            'email' => 'owner@kopinuri.com',
            'password' => Hash::make('password123'),
            'role' => 'owner',
        ]);
    }
}