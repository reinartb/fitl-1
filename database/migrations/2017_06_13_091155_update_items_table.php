<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items_requests', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('request_id')->unsigned()->index();
            $table->foreign('request_id')->references('id')->on('requests')
                ->onDelete('cascade');

            $table->integer('item_id')->unsigned()->index();
            $table->foreign('item_id')->references('id')->on('items')
                ->onDelete('cascade');

            $table->integer('quantity_requested');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('items_requests');
    }
}
