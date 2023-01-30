<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trainer>
 */
class TrainerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $status = [0, 1];

        return [
            'user_id' => fake()->unique()->numberBetween(1, 20),
            'status' => $status[array_rand($status, 1)],
            'has_dbs' => $status[array_rand($status, 1)]
        ];
    }


}
