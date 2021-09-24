<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tails', function (Blueprint $table) {
            $table->id();
            $table->string('agent', 250);
            $table->decimal('duration', $precision = 6, $scale = 2)->nullable();
            $table->decimal('average_time', $precision = 6, $scale = 2)->nullable();
            $table->integer('max_items');
            $table->integer('status');
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
        Schema::dropIfExists('tails');
    }
}
