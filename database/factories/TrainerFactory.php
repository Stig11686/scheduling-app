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
        $name = fake()->name();
        $status = [0, 1];

        return [
            'name' => $name,
            'email' => $this->slugify($name) . '@' . $this->randomEmailGenerator(),
            'phone' => fake()->phoneNumber(),
            'status' => $status[array_rand($status, 1)]
        ];
    }

    private function randomEmailGenerator(){
        $emailProviders = ['aol', 'yahoo', 'gmail', 'hotmail'];
        $suffixes = ['.co.uk', '.com', '.org', '.io', 'ie', '.de', '.in', '.net'];

        return $emailProviders[array_rand($emailProviders, 1)] . $suffixes[array_rand($suffixes, 1)];
    }

    private function slugify($string){
        $string = strtolower($string);
        $string = preg_replace('/[^a-z0-9 -]+/', '', $string);
        $string = str_replace(' ', '-', $string);
        return trim($string);
    }
}
