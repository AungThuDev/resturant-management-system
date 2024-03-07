<?php

namespace Database\Seeders;

use App\Models\CustomerDiscount;
use App\Models\Discount;
use Illuminate\Database\Seeder;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Discount::create([
            'name' => 'Discount 20%',
            'percent'=> 20
        ]);


        Discount::create([
            'name' => 'Discount 15%',
            'percent'=> 15
        ]);

        Discount::create([
            'name' => 'Discount 10%',
            'percent'=> 10
        ]);
        
        CustomerDiscount::create([
            'name' => 'MST student',
            'percent' => 15
        ]);
        CustomerDiscount::create([
            'name' => 'MST staff',
            'percent' => 18
        ]);
        CustomerDiscount::create([
            'name' => 'VIP',
            'percent' => 20
        ]);
        
    }
}
