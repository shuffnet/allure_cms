<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrderItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('order_items', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('job_id')->unsigned();
            $table->foreign('job_id')->references('id')->on('jobs');

            $table->integer('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders');

            $table->integer('contact_id')->unsigned();
            $table->foreign('contact_id')->references('id')->on('contacts');

            $table->string('item');
            $table->integer('type_id')->unsigned();
            $table->boolean('taxable')->default('1');
            $table->integer('price');
            $table->integer('discount')->default(0);
            $table->integer('product_cost');
            $table->integer('labor_cost');
            $table->text('description');
            $table->text('tips');
            $table->text('requirements');
            $table->text('upsale');


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
        //
    }
}
