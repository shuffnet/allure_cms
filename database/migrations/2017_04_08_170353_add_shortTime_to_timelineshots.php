<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddShortTimeToTimelineshots extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('jobtimelineshots', function(Blueprint $table)
        {
            $table->string('shortTime');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jobtimelineshots', function(Blueprint $table)
        {
            $table->dropColumn('shortTime');
        });
        //
    }
}
