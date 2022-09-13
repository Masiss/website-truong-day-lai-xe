<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->string('key')->unique();
            $table->string('value')->nullable();
        });
        DB::table('configs')->insert(
            [
                [
                    'key' => 'price_per_day',
                    'value' => 0
                ],
                [
                    'key' => 'price_full_course',
                    'value' => 0
                ],
                [
                    'key' => 'morning_start',
                    'value' => 7
                ],
                [
                    'key' => 'evening_start',
                    'value' => 14
                ],
                [
                    'key' => 'half_shift',
                    'value' => 2
                ],
                [
                    'key' => 'full_shift',
                    'value' => 4
                ],
                [
                    'key' => 'money_per_hour',
                    'value' => 100000
                ],
                [
                    'key' => 'deducted_per_rating',
                    'value' => 500000
                ],
                [
                    'key' => 'phone_numbers',
                    'value' => '0123456789',
                ],
                [
                    'key' => 'address',
                    'value' => '105/3 Bình Quới, Bình Thạnh, TP.HCM',
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
                    'value' => 'hopelessornohope@gmail.com',
                ],
                [
                    'key' => 'banner_1',
                    'value' => null,
                ],
                [
                    'key' => 'banner_2',
                    'value' => null,
                ],
                [
                    'key' => 'banner_bottom',
                    'value' => null,
                ],
                [
                    'key' => 'logo',
                    'value' => null,

                ],
                [
                    'key' => 'fb',
                    'value' => 'fb.com/100011090085352',
                ],
                [
                    'key' => 'ig',
                    'value' => 'instagr.am/binhnguyen.03',
                ],


            ],

        );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configs');
    }
};
