<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //

            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'profilePhoto' => $this->faker->imageUrl($width = 640, $height = 480),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'role_id' => $this->faker->numberBetween(1, 3),
        ];
    }
}
