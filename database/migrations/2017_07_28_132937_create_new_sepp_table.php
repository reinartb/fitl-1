p<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewSeppTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sepp', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id')->unsigned();

            $table->foreign('item_id')
                ->references('id')->on('items')
                ->onDelete('cascade');

            $table->integer('section_id')->unsigned();
            
            $table->foreign('section_id')
                ->references('id')->on('sections')
                ->onDelete('cascade');

            $table->smallInteger('year');

            $table->integer('q1_quantity');
            $table->integer('q2_quantity');
            $table->integer('q3_quantity');
            $table->integer('q4_quantity');

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
        Schema::dropIfExists('sepp');
    }
}
