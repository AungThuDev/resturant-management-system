<?php

namespace Database\Seeders;

use App\Models\DinningPlan;
use Illuminate\Database\Seeder;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tables = ['Table 1', 'Table 2', 'Table 3', 'Table 4', 'Table 5', 'Table 6'];

        foreach($tables as $table)
        {
            DinningPlan::create([
                'name' => $table,
                'status' => 'available'
            ]);
        }
    }
}
