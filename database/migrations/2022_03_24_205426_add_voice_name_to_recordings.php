<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVoiceNameToRecordings extends Migration
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
                $table->text('voice_name')->after('path')->nullable();
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
        if (Schema::hasColumn('recordings', 'voice_name')) {
            Schema::table('recordings', function (Blueprint $table) {
                $table->dropColumn('voice_name');
            });
        }
    }
}
