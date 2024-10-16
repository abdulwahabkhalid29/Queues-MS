<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id('ticket_id');
            $table->foreignId('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreignId('business_id')->references('business_id')->on('businesses')->onDelete('cascade');
            $table->foreignId('counter_id')->references('counter_id')->on('counters')->onDelete('cascade');
            $table->string('ticket_number');
            $table->enum('status', ['waiting', 'serving', 'completed', 'cancelled'])->default('waiting');
            $table->timestamp('created_time')->useCurrent();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
