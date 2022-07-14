<?php

namespace Database\Factories;

use App\Enums\LessonStatusEnum;
use App\Models\Driver;
use App\Models\Instructor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'driver_id' => Driver::query()->inRandomOrder()->value('id'),
            'ins_id' => Instructor::query()->inRandomOrder()->value('id'),
            'last' => random_int(2, 4),
            'start_at' => random_int(7, 16),
            'date' => $this->faker->dateTimeBetween('now'),
            'rating' => $this->faker->numberBetween(1, 5),
            'status' => random_int(0,3),
        ];
    }
}
