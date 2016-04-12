<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddFieldsToPresencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('presences', function (Blueprint $table) {
            $table->integer('party_id');
            $table->integer('is_coalition');
            $table->integer('week_day');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('presences', function (Blueprint $table) {
            $table->dropColumn('party_id');
            $table->dropColumn('is_coalition');
            $table->dropColumn('week_day');
        });
    }
}
