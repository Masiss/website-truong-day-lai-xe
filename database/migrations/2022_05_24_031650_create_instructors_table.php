<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone_numbers', 10);
            $table->date('birthdate');
            $table->boolean('gender');
            $table->string('avatar')->nullable();
            $table->string('password');
            $table->tinyInteger('level');
            $table->string('remember_token',100)->nullable();
            $table->timestamps();
            $table->softDeletes();

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('instructors', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::dropIfExists('instructors');
    }
};
