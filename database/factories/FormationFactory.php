<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Formation>
 */
class FormationFactory extends Factory
{
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $list=['developement digital','AI','infstructure digital','mechanique'];
        return [
            'title'=>$this->faker->randomElement($list),
            'description'=>$this->faker->text(150),
            'duree'=>$this->faker->numberBetween(1,12),
            'date_debut'=>$this->faker->date(),
            'date_fin'=>$this->faker->date()
        ];
    }
}
