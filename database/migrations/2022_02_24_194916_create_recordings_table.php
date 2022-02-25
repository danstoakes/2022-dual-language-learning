<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('recordings')) {
            Schema::create('recordings', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('phrase_id');
                $table->foreign('phrase_id')->references('id')->on('phrases')->onDelete('cascade');
                $table->unsignedBigInteger('recording_id');
                $table->timestamps();
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
        Schema::dropIfExists('recordings');
    }
}
