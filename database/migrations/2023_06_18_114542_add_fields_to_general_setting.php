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
        Schema::table('general_settings', function (Blueprint $table) {
            $table->tinyInteger('welcome_mail_on_new_user_sign_in')->nullable()->after('promo_on_new_user_sign_in')->comment('0:off, 1:on');
            $table->tinyInteger('weekly_newsletter')->nullable()->after('welcome_mail_on_new_user_sign_in')->comment('0:off, 1:on');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('general_setting', function (Blueprint $table) {
            //
        });
    }
};
