<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vessel>
 */
class VesselFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'mmsi' => $this->faker->randomDigit() * 100000000,
            'status' => 1,
            'stationId' => $this->faker->randomDigit(),
            'speed' => $this->faker->randomDigit() * 100,
            'lon' => $this->faker->randomDigit() * 10,
            'lat' => $this->faker->randomDigit() * 10,
            'course' => $this->faker->randomDigit() * 100,
            'heading' => $this->faker->randomDigit() * 100,
            'rot' => "",
            'timestamp' => now(),
        ];
    }
}
