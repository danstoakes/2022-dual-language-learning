<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFilenameToRecordings extends Migration
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
                $table->text('file_name')->after('id');
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
        if (Schema::hasColumn('recordings', 'file_name')) {
            Schema::table('recordings', function (Blueprint $table)
            {
                $table->dropColumn('file_name');
            });
        }
    }
}
