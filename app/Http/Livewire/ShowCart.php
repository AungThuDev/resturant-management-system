<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\Recipe;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ShowCart extends Component
{
    protected $listeners = ['itemAdded' => 'render'];

    public function render()
    {
        $cart_items = Cart::all();
        $cost = 0;
        foreach($cart_items as $cart_item)
        {
            $cost += $cart_item->price;
        }

        $total = $cost + ($cost * 0.1);

        return view('livewire.show-cart', ['items' => $cart_items, 'cost' => $cost, 'total' => $total]);
    }

    public function increment(Cart $item)
    {
        $recipe = Recipe::where('name', $item->name)->first();
        $item->update([
            'quantity' => DB::raw('quantity+1'),
            'price' => DB::raw("price+{$recipe->price}")
        ]);
    }

    public function decrement(Cart $item)
    {
        $recipe = Recipe::where('name', $item->name)->first();
        $item->update([
            'quantity' => DB::raw('quantity-1'),
            'price' => DB::raw("price-{$recipe->price}")
        ]);
    }

    public function delete(Cart $item)
    {
        $item->delete();
    }
}
