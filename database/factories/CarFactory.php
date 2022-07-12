<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $car = randomMakeAndModel();

        return [
            'make' => $car['make'],
            'model' => $car['model'],
            'year' => random_int(2000,2022),
            'condition' => collect(['used', 'new'])->random(),
            'price' => random_int(5000,45000)*100,
            'status' => collect(['for sale', 'pending', 'sold'])->random(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
