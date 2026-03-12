<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'designation'=>$this->faker->unique()->text('30'),
            'prix'=>$this->faker->randomFloat(2,1000,10000),
            'quantite'=>$this->faker->randomFloat(0,1,100)
        ];
    }
}
