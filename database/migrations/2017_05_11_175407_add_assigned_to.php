<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAssignedTo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        //
        Schema::table('taskitems', function(Blueprint $table)
        {
            $table->integer('assigned_to')->unsigned();
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
        Schema::table('taskitems', function(Blueprint $table)
        {
            $table->dropColumn('assigned_to');
        });
    }
}
