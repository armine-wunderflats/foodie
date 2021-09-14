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
            $table->increments('id');
            $table->string('status')->default('Placed');
            $table->text('address');
            $table->text('instructions')->nullable();
            $table->datetime('placed_on');
            $table->datetime('canceled_on')->nullable();
            $table->datetime('processing_on')->nullable();
            $table->datetime('en_route_on')->nullable();
            $table->datetime('delivered_on')->nullable();
            $table->datetime('received_on')->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('restaurant_id')->unsigned();
            
            $table->foreign('restaurant_id')
            ->references('id')
            ->on('restaurants')
            ->onDelete('cascade');
            
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');

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
        Schema::dropIfExists('orders');
    }
}
