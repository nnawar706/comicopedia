<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_statuses')->insert([
            ['id' => 2, 'name' =>'Pending', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' =>'Confirmed', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 1, 'name' => 'Delivered', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' =>'Cancelled', 'created_at' => now(), 'updated_at' => now()]
        ]);
    }
}
