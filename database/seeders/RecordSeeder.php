<?php

namespace Database\Seeders;

use App\Models\SaleRecord;
use Illuminate\Database\Seeder;

class RecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SaleRecord::create([
            'order_id' => 1,
            'amount' => 90000,
            'discounted_amount' => 85000,
            'order_date' => '2024-03-11'
        ]);
        SaleRecord::create([
            'order_id' => 2,
            'amount' => 90000,
            'discounted_amount' => 85000,
            'order_date' => '2024-03-11'
        ]);
        SaleRecord::create([
            'order_id' => 3,
            'amount' => 90000,
            'discounted_amount' => 85000,
            'order_date' => '2024-03-11'
        ]);
        SaleRecord::create([
            'order_id' => 4,
            'amount' => 90000,
            'discounted_amount' => 85000,
            'order_date' => '2024-03-11'
        ]);
        SaleRecord::create([
            'order_id' => 5,
            'amount' => 90000,
            'discounted_amount' => 85000,
            'order_date' => '2024-03-11'
        ]);
        SaleRecord::create([
            'order_id' => 6,
            'amount' => 90000,
            'discounted_amount' => 85000,
            'order_date' => '2024-03-11'
        ]);
        SaleRecord::create([
            'order_id' => 7,
            'amount' => 90000,
            'discounted_amount' => 85000,
            'order_date' => '2024-03-11'
        ]);
        SaleRecord::create([
            'order_id' => 8,
            'amount' => 90000,
            'discounted_amount' => 85000,
            'order_date' => '2024-03-12'
        ]);
        SaleRecord::create([
            'order_id' => 9,
            'amount' => 90000,
            'discounted_amount' => 85000,
            'order_date' => '2024-03-12'
        ]);
        SaleRecord::create([
            'order_id' => 10,
            'amount' => 90000,
            'discounted_amount' => 85000,
            'order_date' => '2024-03-13'
        ]);
    }
}
