<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class InstructorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('instructors')->insert([
            [
                'name' => 'Binh Nguyen',
                'gender' => 0,
                'email' => 'alo123@alo',
                'birthdate' => '2003/11/03',
                'phone_numbers' => '0123456789',
                'password' => Hash::make(123),
                'level' => 1,
            ], [
                'name' => 'Binh Nguyen',
                'gender' => 0,
                'email' => 'alo@alo',
                'birthdate' => '2003/11/03',
                'phone_numbers' => '0123456789',
                'password' => Hash::make(123),
                'level' => 0,
            ],
        ]);
    }
}
