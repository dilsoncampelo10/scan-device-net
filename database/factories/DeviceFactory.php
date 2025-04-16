<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Device>
 */
class DeviceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ip' => $this->faker->ipv4(),
            'mac' => $this->faker->macAddress(),
            'manufacturer' => $this->faker->company(),
            'last_seen_time' => $this->faker->dateTimeBetween('-1 days', 'now'),
        ];
    }
}
