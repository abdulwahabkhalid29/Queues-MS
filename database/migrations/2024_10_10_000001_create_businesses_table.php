<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessesTable extends Migration
{
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->id('business_id');
            $table->string('user_id');
            $table->string('business_name');
            $table->string('business_type');
            $table->string('email')->unique();
            $table->string('phone_number')->nullable();
            $table->text('address')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('businesses');
    }
}
