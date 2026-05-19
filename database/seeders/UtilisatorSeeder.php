<?php

namespace Database\Seeders;

use App\Models\Utilisator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UtilisatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Utilisator::create([
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin'
        ]);

        Utilisator::create([
            'username' => 'trainer',
            'email' => 'trainer@example.com',
            'password' => bcrypt('trainer123'),
            'role' => 'formateur'
        ]);

        Utilisator::create([
            'username' => 'client',
            'email' => 'client@example.com',
            'password' => bcrypt('client123'),
            'role' => 'client'
        ]);

        Utilisator::factory(10)->create();
    }
}
