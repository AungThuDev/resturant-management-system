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

    public $filter = '';

    public function render()
    {
        $query = Recipe::query();

        if($this->search)
        {
            $query->where('name', 'like', '%' . $this->search . '%');
        }
        if($this->filter)
        {
            // $query = Category::where('name', 'like', '%' . $this->filter . '%')->with('recipes')->get();
            dd($this->filter);
        }
        $recipes = $query->latest()->paginate(10);

        return view('livewire.show-recipes', ['recipes' => $recipes, 'categories' => $this->categories]);
    }

    public function addToCart(Recipe $recipe)
    {
        $check = Cart::where('name', $recipe->name)->first();

        if($check)
        {
            $check->update([
                'price' => DB::raw("price + {$recipe->price}"),
                'quantity' => DB::raw('quantity+1')
            ]);
        }
        else
        {
            Cart::create([
                'name' => $recipe->name,
                'price' => $recipe->price,
                'quantity' => 1
            ]);
        }

        $this->emit('itemAdded');
    }
}
