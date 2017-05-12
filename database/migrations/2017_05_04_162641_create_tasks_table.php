<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('job_id')->unsigned();
            $table->integer('session_id')->unsigned();
            $table->integer('order_id')->unsigned();

            $table->integer('product_id')->unsigned();


            $table->string('task');
            $table->string('status');
            $table->integer('contact_id')->unsigned();
            $table->boolean('pinned');
            $table->string('pin_reason');
            $table->text('notes');
            $table->date('dueDate');
            $table->integer('dueDateRules_id');
            $table->integer('dueDateRulesTime');
            $table->integer('startDateRules_id');
            $table->integer('startDateRulesTime');

            $table->integer('processTimeRules');
            $table->string('created_by');





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
        Schema::drop('tasks');
    }
}
