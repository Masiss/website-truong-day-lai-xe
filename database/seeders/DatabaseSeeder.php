<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Driver;
use App\Models\Instructor;
use App\Models\Lesson;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        Course::factory(50)->create();
        Driver::factory(200)->create();
        Instructor::factory(50)->create();
        Lesson::factory(100)->create();
    }
}
