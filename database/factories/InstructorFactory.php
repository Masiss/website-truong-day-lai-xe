<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Instructor>
 */
class InstructorFactory extends Factory
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
            'email'=>$this->faker->email(),
            'phone_numbers'=>$this->faker->unique()->numberBetween(1111111111,9999999999),
            'gender'=>$this->faker->boolean(),
            'salary'=>$this->faker->numberBetween(3000000,5000000),
        ];
    }
}
