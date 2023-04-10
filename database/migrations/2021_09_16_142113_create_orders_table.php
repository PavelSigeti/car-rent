<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->constrained();
            $table->integer('price');
            $table->integer('delivery_price');
            $table->integer('delivery_price_back');
            $table->integer('total_price');
            $table->integer('days');
            $table->integer('start_place_id')->unsigned();
            $table->integer('end_place_id')->unsigned();
            $table->dateTime('start_at');
            $table->dateTime('end_at');
            $table->string('name');
            $table->string('phone');
            $table->text('comment')->nullable();
            $table->string('status');
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
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('orders');
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
