<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Call all individual seeders
        $this->call([
            BusinessesTableSeeder::class,
            UsersTableSeeder::class,
            CountersTableSeeder::class,
            TicketsTableSeeder::class,
            TransactionLogsTableSeeder::class,
        ]);
    }
}
