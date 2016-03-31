<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterFieldPartyIdToIntegerKnessetmembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('knessetmembers', function (Blueprint $table) {
            $table->unsignedInteger('party_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('knessetmembers', function (Blueprint $table) {
            $table->string('party_id')->change();
        });
    }
}
