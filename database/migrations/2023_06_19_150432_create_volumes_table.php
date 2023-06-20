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
        Schema::create('volumes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained('items')->onDelete('restrict');
            $table->foreignId('catalogue_id')->constrained('catalogues')->onDelete('restrict');
            $table->string('product_unique_id');
            $table->text('details');
            $table->timestamp('release_date');
            $table->integer('quantity');
            $table->float('price');
            $table->float('discount')->nullable()->comment('percentage');
            $table->float('cost');
            $table->string('image_path')->nullable();
            $table->tinyInteger('status')->default(1)->comment('0:unavailable, 1:available');
            $table->integer('view_count')->default(0);
            $table->integer('review_count')->default(0);
            $table->integer('sell_count')->default(0);
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
        Schema::dropIfExists('volumes');
    }
};
