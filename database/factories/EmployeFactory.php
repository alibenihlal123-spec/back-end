<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employe>
 */
class EmployeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'matrice'=>$this->faker->unique()->text(20),
            'cin'=>$this->faker->unique()->text(20),
            'nom'=>$this->faker->lastName(),
            'prenom'=>$this->faker->firstName(),
            'email'=>$this->faker->unique()->email(),
            'date_embauche'=>$this->faker->dateTimeBetween('-6 years','now'),
            'salaire'=>$this->faker->randomFloat(2,3000,12000)
        ];
    }
}
