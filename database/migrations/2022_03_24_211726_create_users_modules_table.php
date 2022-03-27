<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('users_modules')) {
            Schema::create('users_modules', function (Blueprint $table) {
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('module_id');
                $table->integer('most_recent_score')->default(0);
                $table->integer('average_score')->default(0);
                $table->integer('attempt_count')->default(0);

                $table->foreign('user_id')->references('id')->on('users')->onDelete("cascade");
                $table->foreign('module_id')->references('id')->on('modules')->onDelete("cascade");
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_modules');
    }
}
