<?php

namespace Database\Seeders;

use App\Models\Recipe;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $recipes = ['mm dish', 'indian dish', 'american dish', 'korean dish', 'chinese dish', 'thai dish'];

        foreach($recipes as $recipe)
        {
            Recipe::create([
                'name' => $recipe,
                'price' => 5000,
                'category_id' => 1,
                'kitchen_id' => 1,
                'image' => 'recipe.png'
            ]);
        }
    }
}
