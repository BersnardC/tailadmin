<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Items extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->integer('code');
            $table->string('name', 250);
            $table->date('created_at');
            $table->time('start');
            $table->time('finish')->nullable();
            $table->decimal('atention_time', $precision = 6, $scale = 2);
            $table->integer('status');
            $table->unsignedBigInteger('tail_id');
            $table->foreign('tail_id')->references('id')->on('tails');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
