<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('session_type_id')->unsigned();
            $table->date('date');
            $table->time('time');
            $table->text('notes');
            $table->integer('photographer_id')->unsigned();
            $table->string('location');
            $table->timestamps();
            $table->integer('confirmed')->unsigned();
            $table->string('imagepath');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sessions');
    }
}
