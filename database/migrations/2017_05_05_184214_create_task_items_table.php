<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taskItems', function (Blueprint $table) {

            $table->increments('id');
            $table->string('task');
            $table->integer('dueDateRules_id');
            $table->integer('dueDateRulesTime');
            $table->integer('processTimeRules');
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
        Schema::drop('taskItems');
    }
}
