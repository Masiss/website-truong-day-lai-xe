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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('gender');
            $table->foreignId('course_id')->constrained('courses');
            $table->string('id_numbers', 12);
            $table->string('email')->unique();
            $table->string('phone_numbers', 10);
            $table->date('birthdate');
            $table->string('file');
            $table->boolean('is_full');
            $table->string('password');
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
        Schema::table('drivers', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::dropIfExists('drivers');

    }
};
