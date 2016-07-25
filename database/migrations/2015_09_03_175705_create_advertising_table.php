<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdvertisingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertising', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id');
            $table->boolean('type');
            $table->string('title');
            $table->text('description');
            $table->double('price');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->integer('location');
            $table->integer('city');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('advertising');
    }
}
