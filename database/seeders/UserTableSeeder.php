<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Customer

        DB::table('users')->insert([
            [
                "full_name" => "Yu Nandar Moe Customer",
                "username" => "Customer",
                "email" => "customer@gmail.com",
                "password" => Hash::make('111'),
                "status" => "active"
            ],
        ]);

        // admin
        DB::table('admins')->insert([
            // Admin
            [
                "full_name" => "Yu Nandar Moe Admin",
                "username" => "Admin",
                "email" => "admin@gmail.com",
                "password" => Hash::make('111'),
                "status" => "active"
            ],
        ]);
    }
}
