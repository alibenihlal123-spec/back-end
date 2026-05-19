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
            'email'=>$this->faker->unique()->safeEmail()
            // 'password'=>$this->faker->password(6,8)
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (\App\Models\Participent $participent) {
            $baseUsername = strtolower($participent->prenom . '_' . $participent->nom);
            $generatedUsername = $baseUsername;
            $counter = 1;
            while (\App\Models\Utilisator::where('username', $generatedUsername)->exists()) {
                $generatedUsername = $baseUsername . '_' . $counter;
                $counter++;
            }
            $utilisator = \App\Models\Utilisator::firstOrCreate([
                'email' => $participent->email,
            ], [
                'username' => $generatedUsername,
                'password' => bcrypt('client123'),
                'role' => 'client'
            ]);
            $participent->utilisator_id = $utilisator->id;
            $participent->save();
        });
    }
}
