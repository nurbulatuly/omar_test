<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserAddress>
 */
class UserAddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->address(),
            'province_id' => $this->faker->numberBetween(1, 17),
            'postal_code' => $this->faker->postcode(),
            'city' => $this->faker->city(),
            'street' => $this->faker->streetName(),
            'house' => $this->faker->numberBetween(1, 500),
            'apartment' => $this->faker->numberBetween(1, 100),
            'lat' => $this->faker->latitude(),
            'lon' => $this->faker->longitude(),
            'user_id' => User::inRandomOrder()->first()->id
        ];
    }
}
