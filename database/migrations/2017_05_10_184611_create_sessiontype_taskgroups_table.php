<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessiontypeTaskgroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessiontype_taskgroups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('session_types_id')->unsigned();
            $table->foreign('session_types_id')->references('id')->on('session_types');

            $table->integer('taskgroup_id');
            $table->foreign('taskgroup_id')->references('id')->on('taskgroup');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sessiontype_taskgroups');
    }
}
