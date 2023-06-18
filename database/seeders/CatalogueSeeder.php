<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatalogueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('catalogues')->insert(
            ['name' => 'New Arrivals', 'created_at' => now(), 'updated_at' => now()],
            ['name' =>'Upcoming Releases', 'created_at' => now(), 'updated_at' => now()],
            ['name' =>'Bestsellers', 'created_at' => now(), 'updated_at' => now()],
            ['name' =>'Featured', 'created_at' => now(), 'updated_at' => now()],
            ['name' =>'Offers', 'created_at' => now(), 'updated_at' => now()]
        );
    }
}
