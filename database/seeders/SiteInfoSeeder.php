<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiteInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('site_information')->insert([
            'name' => 'MangaMania',
            'email' => 'manga-mania@manga.com',
            'contact' => '+8801623874561',
            'logo_path' => 'N/A',
            'favicon_path' => 'N/A',
            'about' => 'N/A',
        ]);
    }
}
