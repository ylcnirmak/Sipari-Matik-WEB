<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Yönetici Hesabı',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Restaurant Hesabı',
            'email' => 'restaurant@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'restaurant'
        ]);

        User::create([
            'name' => 'Garson Hesabı',
            'email' => 'garson@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'garson'
        ]);

        User::create([
            'name' => 'Kurye Hesabı',
            'email' => 'kurye@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'kurye'
        ]);

        User::create([
            'name' => 'Muhasebe Hesabı',
            'email' => 'muhasebe@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'muhasebe'
        ]);
    }
}