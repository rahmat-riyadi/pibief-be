<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vendor>
 */
class VendorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'province' => $this->faker->city,
            'city' => $this->faker->city,
            'district' => $this->faker->city,
            'neighborhood' => $this->faker->city,
            'address' => $this->faker->address,
        ];
    }
}
