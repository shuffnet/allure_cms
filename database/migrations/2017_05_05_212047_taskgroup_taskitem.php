<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TaskgroupTaskitem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('taskgroup_taskitems', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('taskgroup_id')->unsigned();
            $table->foreign('taskgroup_id')->references('id')->on('taskgroup');
            $table->integer('taskitems_id')->unsigned();
            $table->foreign('taskitems_id')->references('id')->on('taskitems');


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
        Schema::drop('taskgroup_taskitem');
    }
}
