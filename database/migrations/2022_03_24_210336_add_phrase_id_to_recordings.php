<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhraseIdToRecordings extends Migration
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
                $table->unsignedBigInteger('phrase_id')->after('id');
                $table->foreign('phrase_id')->references('id')->on('phrases');
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
        if (Schema::hasColumn('recordings', 'phrase_id')) {
            Schema::table('recordings', function (Blueprint $table) {
                $table->dropForeign('recordings_phrase_id_foreign');
                $table->dropColumn('phrase_id');
            });
        }
    }
}
