<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulesPhrasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('modules_phrases')) {
            Schema::create('modules_phrases', function (Blueprint $table) {
                $table->unsignedBigInteger('module_id');
                $table->unsignedBigInteger('phrase_id');

                $table->foreign('module_id')->references('id')->on('modules')->onDelete("cascade");
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
        Schema::dropIfExists('modules_phrases');
    }
}
