<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Docteur>
 */
class DocteurFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom'=>fake()->name(),
            'prenom'=>fake()->name(),
            'numero'=>fake()->e164PhoneNumber(),
            'adresse'=>fake()->address()                      
        ];
    }
}
