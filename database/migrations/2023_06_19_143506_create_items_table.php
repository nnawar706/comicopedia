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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('genre_id')->constrained('genres')->onDelete('restrict');
            $table->string('title')->unique();
            $table->text('detail');
            $table->string('author');
            $table->string('magazine');
            $table->string('image_path');
            $table->string('meta_keywords',250);
            $table->tinyInteger('volumes')->default(0);
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
        Schema::dropIfExists('items');
    }
};
