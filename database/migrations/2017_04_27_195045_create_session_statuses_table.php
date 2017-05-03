<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('session_task', function (Blueprint $table) {
            $table->increments('id');
            $table->string('task');
            $table->integer('task_status_id')->unsigned();
            $table->integer('assigned_to_id')->unsigned();
            $table->boolean('pinned');
            $table->text('notes');
            $table->date('dueDate');
            $table->integer('dueDateRules');
            $table->integer('startDateRules');
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
        Schema::drop('session_task');
    }
}
