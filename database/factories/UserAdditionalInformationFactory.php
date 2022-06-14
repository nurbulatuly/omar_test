<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserAdditionalInformation>
 */
class UserAdditionalInformationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $gender = $this->faker->randomElement(['M', 'F']);


        return [
            'gender' => $gender,
            'date_of_birth' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'marital_status' => $this->faker->randomElement(['M','S','D','W']),
            'has_children' => $this->faker->numberBetween(0,1),
            'family_persons_count' => $this->faker->numberBetween(1,5)
        ];
    }
}
