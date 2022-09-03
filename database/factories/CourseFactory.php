<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'type' => random_int(0, 2),
            'days_of_week' =>(Arr::random([
                'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'
            ],2)),
            'price' => $this->faker->numberBetween(1000000, 10000000),
            'price_per_day' => $this->faker->numberBetween(200000, 400000),

        ];
    }
}
