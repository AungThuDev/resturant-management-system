<?php

namespace Database\Seeders;

use App\Models\Taste;
use Illuminate\Database\Seeder;

class TasteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tastes = ['normal', 'sweet', 'spicy'];

        foreach($tastes as $taste)
        {
            Taste::create([
                'name' => $taste
            ]);
        }
    }
}
