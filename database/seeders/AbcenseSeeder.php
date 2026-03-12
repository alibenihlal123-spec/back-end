<?php

namespace Database\Seeders;

use App\Models\Abcense;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AbcenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Abcense::factory(2)->create();
    }
}
