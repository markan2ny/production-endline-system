<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStyleIdToModelEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('model_entries', function (Blueprint $table) {
            $table->unsignedBigInteger('style_id');
            $table->foreign('style_id')->references('id')->on('styles')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('model_entries', function (Blueprint $table) {
            //
        });
    }
}
