<?php

use App\Models\Config;
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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type');
            $table->integer('price')->nullable();
            $table->integer('price_per_day')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        foreach(\App\Enums\CourseTypeEnums::cases() as $type){
            $price= Config::query()->where('key',$type->name)->first()->value;
            $price_per_day= Config::query()->where('key',$type->name.'_per_day')->first()->value;
            DB::table('courses')->insert(
                [
                    [
                        'type' => $type->value,
                        'price' => $price,
                        'price_per_day'=>$price_per_day,
                    ],
                ]
            );
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
};
