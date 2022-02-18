<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('costs',function(Blueprint $table){

            $table->increments('id');
            $table->integer('id_offices')->unsigned();
            $table->string('type');
            $table->double('amount');
            $table->string('file');
            $table->integer('month');
            $table->integer('year');
            $table->integer('id_user')->unsigned();
            $table->timestamps();
            $table->foreign('id_offices')->references('id')->on('offices');
            $table->foreign('id_user')->references('id')->on('users');

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
        Schema::drop('costs');
    }
};
