<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Participent>
 */
class ParticipentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom'=>$this->faker->lastName(),
            'prenom'=>$this->faker->firstName(),
            'email'=>$this->faker->unique()->email()
            // 'password'=>$this->faker->password(6,8)
        ];
    }
}
