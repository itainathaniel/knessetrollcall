<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddProcessedFieldToEntranceLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('entrance_logs', function (Blueprint $table) {
            $table->boolean('processed');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('entrance_logs', function (Blueprint $table) {
            $table->dropColumn('processed');
        });
    }
}
