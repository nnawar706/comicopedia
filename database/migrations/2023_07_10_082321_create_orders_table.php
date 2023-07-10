<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('address_id')->constrained('order_addresses')->onDelete('restrict');
            $table->string('order_no')->unique();
            $table->string('delivery_tracking_no')->unique();
            $table->string('contact');
            $table->tinyInteger('is_promo')->default(0);
            $table->float('promo_discount')->default(0.00);
            $table->float('shipping_cost')->default(0.00);
            $table->float('total')->default(0.00);
            $table->string('user_comment',300)->default('N/A');
            $table->string('user_comment',300)->default('N/A');
            $table->foreignId('status_id')->constrained('order_statuses')->onDelete('restrict');
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
};
