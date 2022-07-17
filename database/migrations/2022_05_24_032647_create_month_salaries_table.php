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
        Schema::create('month_salaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ins_id')->nullable()->constrained('instructors');
            $table->date('month');
            $table->integer('total_lessons');
            $table->integer('total_hours');
            $table->integer('total_salaries');
            $table->tinyInteger('status')->default(0);
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
        Schema::table('month_salaries', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::dropIfExists('month_salary');
    }
};
