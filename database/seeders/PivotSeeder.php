<?php

namespace Database\Seeders;

use App\Models\pivot;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PivotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        pivot::factory(4)->create();
    }
}
