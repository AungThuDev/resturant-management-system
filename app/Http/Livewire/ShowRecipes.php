<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Recipe;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ShowRecipes extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    public $categories;

    public $table;

    public $tastes;

    public $filter = '';

    public $taste = [];

    public function render()
    {
        $recipes = Recipe::latest()->paginate(10);

        if($this->filter && $this->search)
        {
            $query = Recipe::where('category_id', $this->filter);

            $recipes = $query->where('name', 'like', '%' . $this->search . '%')->paginate(10);
        }
        elseif($this->search)
        {
           $recipes = Recipe::where('name', 'like', '%' . $this->search . '%')->paginate(10);
            
        }
        elseif($this->filter)
        {   
            $recipes = Recipe::where('category_id', $this->filter)->paginate(10);
        }   

        return view('livewire.show-recipes', ['recipes' => $recipes, 'categories' => $this->categories, 'table' => $this->table, 'tastes' => $this->tastes]);
    }

    public function addToCart(Recipe $recipe, $id)
    {

        $check = Cart::where('recipe_id', $recipe->id)->where('dinning_plan_id', $id)->where('taste', $this->taste[$recipe->id])->first();

        if($check)
        {
            $check->update([
                'price' => DB::raw("price + {$recipe->price}"),
                'quantity' => DB::raw('quantity+1')
            ]);
        }
        else
        {
            $cart = Cart::create([
                'recipe_id' => $recipe->id,
                'price' => $recipe->price,
                'quantity' => 1,
                'dinning_plan_id' => $this->table->id,
                'taste' => $this->taste[$recipe->id]
            ]);
            
            $cart->recipes()->sync($recipe->id);
        }

        $this->emit('itemAdded');
    }
}
