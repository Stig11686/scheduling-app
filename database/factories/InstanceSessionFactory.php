<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InstanceSession>
 */
class InstanceSessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'instance_id' => fake()->numberBetween(1, 20),
            'session_id' => fake()->numberBetween(1, 100),
            'date' => fake()->dateTimeBetween('+1 day', '+6 months'),
            'trainer_id' => fake()->numberBetween(1, 20),
            'zoom_room_id' => fake()->numberBetween(1,4),
            'cohort_id' => fake()->numberBetween(1, 20),
        ];
    }
}
