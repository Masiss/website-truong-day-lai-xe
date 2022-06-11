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
            'hours'=>$this->faker->randomDigitNotNull(),
            'price'=>$this->faker->randomNumber(),
            'price_per_day'=>$this->faker->randomNumber(),

        ];
    }
}
