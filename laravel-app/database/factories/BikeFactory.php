<?php

namespace Database\Factories;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Model>
 */
class BikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'brand' => $this->faker->randomElement([
                'Yamaha', 'Suzuki', 'Honda', 'BMW', 'Harley DavidSon',
                'Rog', 'Aprilia', 'Benelli', 'Cagiva', 'Ducati', 'Kawasaki'
            ]),
            'model' => $this->faker->word(),
            'kms' => $this->faker->numberBetween(0, 100010),
            'price' => $this->faker->randomFloat(2, 1250, 55000),
            'registered' => $this->faker->boolean()
        ];
    }
}
