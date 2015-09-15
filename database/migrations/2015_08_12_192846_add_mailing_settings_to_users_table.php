<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMailingSettingsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('mail_daily')->default(false);
            $table->boolean('mail_weekly')->default(false);
            $table->boolean('mail_monthly')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('mail_daily');
            $table->dropColumn('mail_weekly');
            $table->dropColumn('mail_monthly');
        });
    }
}
