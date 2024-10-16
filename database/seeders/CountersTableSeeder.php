<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('counters')->insert([
            ['business_id' => 1, 'counter_number' => 'A1'],
            ['business_id' => 2, 'counter_number' => 'B1'],
        ]);
    }
}
