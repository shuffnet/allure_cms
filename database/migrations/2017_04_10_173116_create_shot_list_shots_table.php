<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShotListShotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shot_list_shots', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('shot_list_id')->unsigned();
            $table->string('shot');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('shot_list_shots');
    }
}
