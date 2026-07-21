<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CircuitFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->words(3, true),
            'country_id' => $this->faker->randomElement(['es', 'fr', 'it', 'gb', 'de', 'be', 'mc', 'nl', 'pt', 'ch', 'at', 'se', 'no', 'dk', 'fi', 'pl', 'cz', 'hu', 'ro', 'gr', 'hr']),
            'location' => $this->faker->city . ', ' . $this->faker->country,
            'length' => $this->faker->randomFloat(3, 2, 7),
            'turns' => $this->faker->numberBetween(8, 20),
            'capacity' => $this->faker->numberBetween(10000, 150000),
            'image' => $this->faker->imageUrl(800, 600, 'sports'),
            'description' => $this->faker->paragraph(3),
        ];
    }
}
