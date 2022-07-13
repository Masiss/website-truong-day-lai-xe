<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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
                'birthdate'=>'2021/01/01',
                'is_full'=>0,
                'email' => 'john@example.com',
                'phone_numbers'=>'0123456789',
                'file'=>'http://tny.im/sLH',
                'password' => Hash::make(123),
            ]
        );
    }
}
