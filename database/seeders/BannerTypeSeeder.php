<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannerTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banner_types')->insert([
            ['id' => 1, 'name' => 'Top Banner', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'About Us', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Newsletter Banner', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'name' => 'Contact Banner', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'name' => 'Sales Banner', 'created_at' => now(), 'updated_at' => now()]
        ]);
    }
}
