<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
                    'key' => 'phone_numbers',
                    'value' => '0',
                ],
                [
                    'key' => 'address',
                    'value' => '0',
                ],
                [
                    'key' => 'B1',
                    'value' => '14.000.000',
                ],
                [
                    'key' => 'B2',
                    'value' => '14.000.000',
                ],
                [
                    'key' => 'C',
                    'value' => '16.000.000',
                ],
                [
                    'key' => 'email',
                    'value' => '0',
                ],
                [
                    'key' => 'banner_1',
                    'value'=>null,
                ],
                [
                    'key' => 'banner_2',
                    'value'=>null,

                ],
                [
                    'key' => 'banner_bottom',
                    'value'=>null,

                ],
                [
                    'key' => 'logo',
                    'value'=>null,

                ]

            ],

        );
    }
}
