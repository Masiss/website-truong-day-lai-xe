<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            'days_of_week'=>json_encode($this->faker->randomElements(['Mon','Tue','Wed','Thu','Fri','Sat','Sun'])),
            'price'=>$this->faker->numberBetween(1000000,10000000),
            'price_per_day'=>$this->faker->numberBetween(200000,400000),

        ];
    }
}
