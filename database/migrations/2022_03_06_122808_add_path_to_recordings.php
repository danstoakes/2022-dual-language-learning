<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPathToRecordings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('recordings')) {
            Schema::table('recordings', function (Blueprint $table) {
                $table->text('path')->after('id');
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
        if (Schema::hasColumn('recordings', 'path')) {
            Schema::table('recordings', function (Blueprint $table)
            {
                $table->dropColumn('path');
            });
        }
    }
}
