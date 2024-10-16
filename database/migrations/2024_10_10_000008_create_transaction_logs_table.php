<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionLogsTable extends Migration
{
    public function up()
    {
        Schema::create('transaction_logs', function (Blueprint $table) {
            $table->id('transaction_id');
            $table->foreignId('ticket_id')->references('ticket_id')->on('tickets')->onDelete('cascade');
            $table->string('action');
            $table->timestamp('timestamp')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaction_logs');
    }
}
