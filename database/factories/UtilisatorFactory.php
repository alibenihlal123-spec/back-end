<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Utilisator>
 */
class UtilisatorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         $list = ['cdc','fA','fP'];
        return [
            'username'=>$this->faker->unique()->userName(),
            'email'=>$this->faker->unique()->safeEmail(),
            'password'=>$this->faker->password(8,11), // also removed unique() from password since we dropped that constraint
            'role'=>$this->faker->randomElement($list)
        ];
    }
}
