<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('modules')) 
        {
            Schema::create('modules', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('language_id');
                $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');
                $table->text('name');
                $table->string('description', 1024);
                $table->text('icon_svg');
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
        Schema::dropIfExists('modules');
    }
}
