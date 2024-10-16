<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('tickets')->insert([
            ['business_id' => 1, 'user_id' => 1, 'counter_id' => 1, 'ticket_number' => 'T001', 'status' => 'waiting'],
            ['business_id' => 2, 'user_id' => 2, 'counter_id' => 2, 'ticket_number' => 'T002', 'status' => 'waiting'],
        ]);
    }
}
