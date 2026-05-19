<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Animater>
 */
class AnimaterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom'=>$this->faker->firstName(),
            'prenom'=>$this->faker->lastName(),
            'email'=>$this->faker->unique()->safeEmail(),
            'telephone'=>$this->faker->phoneNumber(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (\App\Models\Animater $animater) {
            $baseUsername = strtolower($animater->prenom . '_' . $animater->nom);
            $generatedUsername = $baseUsername;
            $counter = 1;
            while (\App\Models\Utilisator::where('username', $generatedUsername)->exists()) {
                $generatedUsername = $baseUsername . '_' . $counter;
                $counter++;
            }
            $utilisator = \App\Models\Utilisator::firstOrCreate([
                'email' => $animater->email,
            ], [
                'username' => $generatedUsername,
                'password' => bcrypt('trainer123'),
                'role' => 'formateur'
            ]);
            $animater->utilisator_id = $utilisator->id;
            $animater->save();
        });
    }
}
