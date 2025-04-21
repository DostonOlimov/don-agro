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
        // Schema::create('orders', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('order_number')->unique();
        //     $table->foreignId('customer_id')->constrained()->onDelete('cascade');
        //     $table->enum('status', ['new', 'processing', 'shipped', 'delivered', 'cancelled'])->default('new');
        //     $table->string('currency')->default('USD');
        //     $table->string('country')->nullable();
        //     $table->string('street_address')->nullable();
        //     $table->string('city')->nullable();
        //     $table->string('state')->nullable();
        //     $table->string('postal_code')->nullable();
        //     $table->timestamps();
        // });
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
