<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hero>
 */
class HeroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'image' => $this->faker->imageUrl(),
            'title' => $this->faker->sentence(),
            'subtitle' => $this->faker->sentence(),
            'link1' => $this->faker->Url(),
            'link2' => $this->faker->Url(),
            'is_active' => $this->faker->boolean()
        ];
    }
}