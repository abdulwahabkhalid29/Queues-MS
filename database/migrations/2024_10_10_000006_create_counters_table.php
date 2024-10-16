<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountersTable extends Migration
{
    public function up()
    {
        Schema::create('counters', function (Blueprint $table) {
            $table->id('counter_id');
            $table->foreignId('business_id')->references('business_id')->on('businesses')->onDelete('cascade');
            $table->string('counter_number');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('counters');
    }
}
