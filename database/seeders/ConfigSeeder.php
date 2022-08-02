<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configs')->insert(
            [
                [
                    'key'=>'số điện thoại',
                    'value'=>'0',
                ],
                [
                    'key'=>'địa chỉ',
                    'value'=>'0',
                ],
                [
                    'key'=>'B1',
                    'value'=>'14.000.000',
                ],
                [
                    'key'=>'B2',
                    'value'=>'14.000.000',
                ],
                [
                    'key'=>'C',
                    'value'=>'16.000.000',
                ],
                [
                    'key'=>'email',
                    'value'=>'0',
                ],

            ],

        );
    }
}
