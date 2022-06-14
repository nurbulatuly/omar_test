<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserAdditionalInformation;
use App\Models\UserAddress;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'country_code' => 'KAZ',
            'phone_number' => $this->faker->phoneNumber(),
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'organization_title' => $this->faker->company(),
            'registration_number' => $this->faker->numberBetween(100000000000, 999999999999),
            'include_vat' => $this->faker->numberBetween(0, 1),
            'has_license' => $this->faker->numberBetween(0, 1),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'current_state' => 'active'
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            //
            UserAddress::factory()
                ->for($user)
                ->create();

            UserAdditionalInformation::factory()
                ->for($user)
                ->create();

            $wallet = $user->wallet();

            $user->wallet->deposit($this->faker->numberBetween(100000, 1000000000));
        });
    }
}
