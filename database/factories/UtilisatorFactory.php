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
            'email'=>$this->faker->unique()->email(),
            'password'=>$this->faker->unique()->password(8,11),
            'role'=>$this->faker->randomElement($list)
        ];
    }
}
