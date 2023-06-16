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
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('notification_on_new_order')->default(0)->comment('0:off, 1:on');
            $table->tinyInteger('mail_on_new_signin')->default(0)->comment('0:off, 1:on');
            $table->tinyInteger('promo_on_signin')->default(0)->comment('0:off, 1:on');
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
        Schema::dropIfExists('general_settings');
    }
};
