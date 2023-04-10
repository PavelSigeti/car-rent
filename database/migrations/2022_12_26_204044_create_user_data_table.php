<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_data', function (Blueprint $table) {
            $table->id();
            $table->string('HTTP_X_REAL_IP')->nullable();
            $table->string('HTTP_USER_AGENT')->nullable();
            $table->string('HTTP_ACCEPT_LANGUAGE')->nullable();
            $table->string('HTTP_COOKIE')->nullable();
            $table->string('REQUEST_TIME')->nullable();
            $table->string('REQUEST_METHOD')->nullable();
            $table->string('REQUEST_URI')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_data');
    }
}
