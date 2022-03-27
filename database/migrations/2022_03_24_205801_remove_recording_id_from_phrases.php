<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveRecordingIdFromPhrases extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('phrases', 'recording_id')) {
            Schema::table('phrases', function (Blueprint $table)
            {
                $table->dropForeign('phrases_recording_id_foreign');
                $table->dropColumn('recording_id');
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
        
    }
}
