<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Driver;
use App\Models\Instructor;
use App\Models\Lesson;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Course::factory(30)->create();
        Driver::factory(200)->create();
        Instructor::factory(10)->create();
        $this->call([
            DriversSeeder::class,
            InstructorsSeeder::class,
            ConfigSeeder::class,
        ]);
        Lesson::factory(500)->create();

    }
}
