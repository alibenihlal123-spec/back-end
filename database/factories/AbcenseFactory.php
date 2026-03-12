<?php

namespace Database\Factories;

use App\Models\Formation;
use App\Models\Participent;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Abcense>
 */
class AbcenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'participent_id'=>Participent::inRandomOrder()->value('id'),
            'formation_id'=>Formation::inRandomOrder()->value('id'),
            'justify'=>$this->faker->boolean(),
            'date_absence'=>$this->faker->dateTimeBetween('-1 years','now')
        ];
    }
}
