<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = [];

        for ($i = 0; $i < 10000; $i++) {
            $orders[] = [
                'product_code'  => 'PRODUCT-' . rand(1, 4),
                'qty'           => rand(1, 100),
                'price'         => rand(1000, 1000000),
            ];
        }

        DB::table('orders')->insert($orders);
    }
}
