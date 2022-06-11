<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DriverFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->name(),
            'gender'=>$this->faker->boolean(),
            'course_id'=>Course::query()->inRandomOrder()->value('id'),
            'id_numbers'=>$this->faker->unique()->randomNumber(),
            'email'=>$this->faker->email(),
            'phone_numbers'=>$this->faker->unique()->numberBetween(1111111111,9999999999),
            'birthdate'=>$this->faker->dateTimeBetween('-70 years','-18 years'),
            'file'=>$this->faker->image(),
            'is_full'=>$this->faker->boolean(),


        ];
    }
}
