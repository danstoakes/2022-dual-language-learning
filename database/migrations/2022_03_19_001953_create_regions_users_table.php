<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegionsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('regions_users')) {
            Schema::create('regions_users', function (Blueprint $table) {
                $table->unsignedBigInteger('region_id');
                $table->unsignedBigInteger('user_id');

                $table->foreign('region_id')->references('id')->on('regions')->onDelete("cascade");
                $table->foreign('user_id')->references('id')->on('users')->onDelete("cascade");
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
        Schema::dropIfExists('regions_users');
    }
}
