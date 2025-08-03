<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Créer l'utilisateur admin principal
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@act4communities.org',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
            'is_active' => true,
        ]);

        $admin->assignRole('admin');

        // Créer Louise LOKUMU
        $louise = User::create([
            'name' => 'Louise LOKUMU',
            'email' => 'louise@act4communities.org',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
            'is_active' => true,
        ]);

        $louise->assignRole('admin');

        // Créer Moïse Mbimbe
        $moise = User::create([
            'name' => 'Moïse Mbimbe',
            'email' => 'moise@act4communities.org',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
            'is_active' => true,
        ]);

        $moise->assignRole('editor');
    }
}
