<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTimelineId extends Migration
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
            $table->integer('timeline_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('jobtimelineshots', function(Blueprint $table)
        {
            $table->dropColumn('timeline_id');
        });
    }
}
