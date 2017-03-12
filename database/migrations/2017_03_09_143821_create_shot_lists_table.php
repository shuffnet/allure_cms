<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShotListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shot_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('shots');
            $table->integer('time')->unsigned();
            $table->text('tips');
            $table->integer('order')->unsigned();
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
        Schema::drop('shot_lists');
    }
}
