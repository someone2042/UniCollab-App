<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Group>
 */
class GroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'company' => $this->faker->company(),
            'company' => $this->faker->company(),
            'type' => $this->faker->randomElement(['private', 'public']),
            'description' => $this->faker->paragraph(3)
            //
        ];
    }
}
