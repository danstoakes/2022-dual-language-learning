<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('languages')) 
        {
            Schema::create('languages', function (Blueprint $table) 
            {
                $table->id();
                $table->text("name");
                $table->text('slug');
                $table->string('excerpt', 255)->nullable();
                $table->string('description', 1024);
                $table->text('flag_svg');
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
        Schema::dropIfExists('languages');
    }
}
