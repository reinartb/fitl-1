<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRequestTableWithSectionForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE requests MODIFY COLUMN requested_by_section INT');

        Schema::table('requests', function (Blueprint $table) {
            $table->integer('requested_by_section')->unsigned()->change();

            $table->foreign('requested_by_section')->references('id')->on('sections')->onDelete('cascade');
        });
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('requests', function (Blueprint $table) {
            $table->dropForeign(['requested_by_section']);
        });
            
        DB::statement('ALTER TABLE requests MODIFY COLUMN requested_by_section VARCHAR(255)');
    }
}
