<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\Recipe;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ShowCart extends Component
{
    protected $listeners = ['itemAdded' => 'render'];

    public $table;

    public function render()
    {
        $cart_items = Cart::where('dinning_plan_id', $this->table->id)->with('recipes')->get();

        $cost = 0;
        foreach($cart_items as $cart_item)
        {
            $cost += $cart_item->price;
        }

        $total = $cost + ($cost * 0.1);

        return view('livewire.show-cart', ['items' => $cart_items, 'cost' => $cost, 'total' => $total, 'table' => $this->table]);
    }

    public function increment(Cart $item)
    {
        $recipe = Recipe::where('id', $item->recipe_id)->first();
        $item->update([
            'quantity' => DB::raw('quantity+1'),
            'price' => DB::raw("price+{$recipe->price}")
        ]);
    }

    public function decrement(Cart $item)
    {
        $recipe = Recipe::where('id', $item->recipe_id)->first();
        $item->update([
            'quantity' => DB::raw('quantity-1'),
            'price' => DB::raw("price-{$recipe->price}")
        ]);

        $qty = Cart::where('id', $item->id)->value('quantity');

        if($qty == 0)
        {
            $item->delete();
        }
    }

    public function delete(Cart $item)
    {
        $item->delete();
    }
}
