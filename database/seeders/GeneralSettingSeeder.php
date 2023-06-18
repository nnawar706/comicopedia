<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeneralSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('general_settings')->insert([
            'notify_admins_on_new_order' => 0,
            'email_admins_on_new_user_sign_in' => 0,
            'promo_on_new_user_sign_in' => 1,
            'welcome_mail_on_new_user_sign_in' => 1,
            'weekly_newsletter' => 0,
        ]);
    }
}
