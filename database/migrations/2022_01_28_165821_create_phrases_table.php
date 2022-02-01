<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhrasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('phrases')) 
        {
            Schema::create('phrases', function (Blueprint $table) {
                $table->id();
                $table->text('batch_id'); // i.e, if the phrase exists for three languages, all should have the same batch id to refer to each other
                $table->unsignedBigInteger('module_id');
                $table->foreign('module_id')->references('id')->on('modules')->onDelete('cascade');
                $table->text('phrase');
                $table->boolean('completed');
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
        Schema::dropIfExists('phrases');
    }
}
