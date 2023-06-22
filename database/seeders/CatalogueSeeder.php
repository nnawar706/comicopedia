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
        DB::table('catalogues')->insert([
            ['id' => 1, 'name' => 'New Arrivals', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' =>'Upcoming Releases', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' =>'Bestsellers', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'name' =>'Featured', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'name' =>'Offers', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'name' =>'General', 'created_at' => now(), 'updated_at' => now()]
        ]);
    }
}
