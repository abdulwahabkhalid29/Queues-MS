<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusinessesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('businesses')->insert([
            ['user_id' => 1, 'business_name' => 'TechCorp', 'business_type' => 'IT', 'email' => 'info@techcorp.com', 'phone_number' => '123456789', 'address' => '123 Tech Lane'],
            ['user_id' => 2, 'business_name' => 'MediCare', 'business_type' => 'Healthcare', 'email' => 'contact@medicare.com', 'phone_number' => '987654321', 'address' => '45 Health Road'],
        ]);
    }
}
