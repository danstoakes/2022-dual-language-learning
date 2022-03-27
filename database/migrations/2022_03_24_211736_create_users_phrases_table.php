<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersPhrasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('users_phrases')) {
            Schema::create('users_phrases', function (Blueprint $table) {
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('phrase_id');
                $table->integer('correct_count')->default(0);
                $table->integer('incorrect_count')->default(0);

                $table->foreign('user_id')->references('id')->on('users')->onDelete("cascade");
                $table->foreign('phrase_id')->references('id')->on('phrases')->onDelete("cascade");
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
        Schema::dropIfExists('users_phrases');
    }
}
