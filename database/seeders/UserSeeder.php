<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        User::firstOrCreate(
            ['email' => 'recruteur@example.com'],
            [
                'name' => 'Recruteur Test',
                'password' => Hash::make('password'),
                'role' => 'recruteur',
                'email_verified_at' => now(),
            ]
        );

        // Candidat
        User::firstOrCreate(
            ['email' => 'candidat@example.com'],
            [
                'name' => 'Candidat Test',
                'password' => Hash::make('password'),
                'role' => 'candidat',
                'email_verified_at' => now(),
            ]
        );

    }
}
