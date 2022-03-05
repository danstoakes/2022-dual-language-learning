<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRecordingIdToPhrases extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('phrases')) {
            Schema::table('phrases', function (Blueprint $table) {
                $table->unsignedBigInteger('recording_id')->after('language_id')->nullable();
                $table->foreign('recording_id')->references('id')->on('recordings')->onDelete('cascade');
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
        if (Schema::hasColumn('phrases', 'recording_id')) {
            Schema::table('phrases', function (Blueprint $table)
            {
                $table->dropForeign('phrases_recording_id_foreign');
                $table->dropColumn('recording_id');
            });
        }
    }
}
