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
        Schema::create('bids', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_nft')->unsigned();
            $table->integer('id_user')->unsigned();
            $table->integer('amount');
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_nft')->references('id')->on('nfts');
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
        Schema::dropIfExists('bids');
    }
};
