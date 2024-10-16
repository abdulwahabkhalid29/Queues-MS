<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionLogsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('transaction_logs')->insert([
            ['ticket_id' => 1, 'action' => 'Ticket Created', 'timestamp' => now()],
            ['ticket_id' => 2, 'action' => 'Ticket Created', 'timestamp' => now()],
        ]);
    }
}
