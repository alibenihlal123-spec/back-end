<?php

namespace Database\Factories;

use App\Models\Animater;
use App\Models\Formation;
use App\Models\Participent;
use App\Models\Theme;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\pivot>
 */
class PivotFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'formation_id'=>Formation::inRandomOrder()->value('id'),
            'animater_id'=>Animater::inRandomOrder()->value('id'),
            'theme_id'=>Theme::inRandomOrder()->value('id'),
            // 'participent_id'=>Participent::inRandomOrder()->value('id')
        ];
    }
}
