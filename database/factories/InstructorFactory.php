<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

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
            'birthdate'=>$this->faker->date('Y-m-d'),
            'phone_numbers'=>$this->faker->unique()->numberBetween(1111111111,9999999999),
            'gender'=>$this->faker->boolean(),
            'avatar'=>$this->faker->imageUrl(),

            'password'=>$this->faker->password(),
            'level'=>1,
        ];
    }
}
