<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class DriversSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('drivers')->insert(
            [
                'name' => 'John Doe',
                'gender'=>0,
                'course_id'=>1,
                'id_numbers'=>'123456789123',
                'birthdate'=>'2003/11/03',
                'is_full'=>0,
                'email' => 'john@example.com',
                'phone_numbers'=>'0123456789',
                'days_of_week' =>json_encode(Arr::random([
                    'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'
                ],2)),
                'file'=>'0',
                'password' => Hash::make(123),
            ]
        );
    }
}
