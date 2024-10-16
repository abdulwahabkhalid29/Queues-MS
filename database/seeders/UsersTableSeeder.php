<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            ['name' => 'John Doe', 'email' => 'john@techcorp.com', 'phone_number' => '123456789' , 'password' => Hash::make('123456789')],
            ['name' => 'Jane Smith', 'email' => 'jane@medicare.com', 'phone_number' => '987654321' , 'password' => Hash::make('123456789')],
        ]);
    }
}
