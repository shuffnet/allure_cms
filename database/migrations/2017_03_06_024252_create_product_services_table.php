<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_services', function (Blueprint $table) {
            $table->increments('id');
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
        Schema::drop('product_services');
    }
}
