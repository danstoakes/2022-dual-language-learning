<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSlugToLanguages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('languages')) {
            Schema::table('languages', function (Blueprint $table) {
                $table->text('slug')->after('name')->nullable();
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
        if (Schema::hasColumn('languages', 'slug')) {
            Schema::table('languages', function (Blueprint $table)
            {
                $table->dropColumn('slug');
            });
        }
    }
}
