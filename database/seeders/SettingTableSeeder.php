<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'title' => 'E-mart online shopping',
            'meta_description' => 'E-mart online shopping',
            'meta_keywords' => 'E-mart, Online shopping, E-commerce website',
            'logo' => 'frontend/img/core-img/logo.png',
            'favicon' => '',
            'address' => 'Yangon, Mynmar',
            'email' => 'info.emart@gmail.com',
            'phone' => '0943184522',
            'fax' => '0943184522',
            'footer' => 'Yu Nandar Moe',
            'facebook_url' => '',
            'twitter_url' => '',
            'linkedin_url' => '',
            'pinterest_url' => '',

        ]);
    }
}
