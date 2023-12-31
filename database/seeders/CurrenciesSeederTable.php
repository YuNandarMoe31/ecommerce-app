<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CurrenciesSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->insert(
            [
                [
                    'name' => 'USA Dollar',
                    'symbol' => '$',
                    'exchange_rate' => 1,
                    'code' => 'USD'
                ],
                [
                    'name' => 'Myanmar Kyat',
                    'symbol' => 'Ks.',
                    'exchange_rate' => 3500,
                    'code' => 'KS'
                ]
            ]
        );
    }
}
