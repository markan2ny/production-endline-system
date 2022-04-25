<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->integer('bundle_tag');
            $table->string('model')->nullable();
            $table->string('operator')->nullable();
            $table->integer('operation')->nullable();
            $table->integer('qty')->nullable();;
            $table->string('status')->nullable();;
            $table->integer('qty_of_bad_item')->nullable();
            $table->date('date_time');
            $table->boolean('isCompleted')->default(false);
            $table->string('checkedBy')->nullable();
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
        Schema::dropIfExists('records');
    }
}
