<?php

namespace Database\Seeders;

use App\Models\Kitchen;
use Illuminate\Database\Seeder;

class KitchenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kitchens = ['Kitchen 1', 'Kitchen 2', 'Kitchen 3'];

        foreach($kitchens as $kitchen)
        {
            Kitchen::create([
                'name' => $kitchen
            ]);
        }
    }
}
