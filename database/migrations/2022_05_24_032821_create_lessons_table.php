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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('driver_id')->constrained('drivers');
            $table->foreignId('ins_id')->nullable()->constrained('instructors');
            $table->tinyInteger('last');
            $table->tinyInteger('start_at');
            $table->date('date');
            $table->string('report')->nullable();
            $table->string('rating')->default('5');
            $table->tinyInteger('status');
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
        Schema::table('lessons', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::dropIfExists('lessons');
    }
};
