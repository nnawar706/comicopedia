<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reviews')->insert([
            ['volume_id' => 2, 'user_id' => null, 'comment' => 'Best volume ever!', 'rating' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['volume_id' => 2, 'user_id' => 1, 'comment' =>'Best volume ever!', 'rating' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['volume_id' => 2, 'user_id' => null, 'comment' =>'Best volume ever!', 'rating' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['volume_id' => 2, 'user_id' => null, 'comment' =>'Best volume ever!', 'rating' => 2, 'created_at' => now(), 'updated_at' => now()]
        ]);
    }
}
