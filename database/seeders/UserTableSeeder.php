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
                "full_name" => "Ms.Customer",
                "username" => "Customer",
                "email" => "customer@gmail.com",
                "password" => Hash::make('1234'),
                "status" => "active"
            ],
        ]);

        // admin
        DB::table('admins')->insert([
            // Admin
            [
                "full_name" => "Ms.Admin",
                "username" => "Admin",
                "email" => "admin@gmail.com",
                "password" => Hash::make('1234'),
                "status" => "active"
            ],
        ]);

         // seller
        DB::table('sellers')->insert([
            // Seller
            [
                "full_name" => "Mr.Seller",
                "username" => "Seller",
                "email" => "seller@gmail.com",
                "password" => Hash::make('1234'),
                "status" => "active",
                "address" => "Yangon",
                "phone" => "0946777448",
                "photo" => "",
                "is_verified" => 0
            ],
        ]);
    }
}
