<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelTargetQuotaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_target_quota', function (Blueprint $table) {
            $table->id();
            $table->string('model_name');
            $table->integer('today_qty');
            $table->unsignedBigInteger('model_id');
            $table->foreign('model_id')->references('id')->on('model_entries')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('model_target_quota');
    }
}
