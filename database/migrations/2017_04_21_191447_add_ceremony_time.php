<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCeremonyTime extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('timelines', function(Blueprint $table)
        {
            $table->time('ceremonyTime');
            $table->time('ceremonyEndTime');
            $table->integer('duration')->unsigned();

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
        Schema::table('timelines', function(Blueprint $table)
        {
            $table->dropColumn('ceremonyTime');
            $table->dropColumn('ceremonyEndTime');
            $table->dropColumn('duration')->unsigned();
        });
    }
}
