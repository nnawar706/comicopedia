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
        Schema::table('banner_settings', function (Blueprint $table) {
            $table->string('title')->nullable()->after('banner_type_id');
            $table->string('subtitle')->nullable()->after('title');
            $table->string('button_text')->nullable()->after('subtitle');
            $table->string('button_url')->nullable()->after('button_text');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('banner_settings', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('subtitle');
            $table->dropColumn('button_text');
            $table->dropColumn('button_url');
        });
    }
};
