<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\DinningPlan;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(DinningPlan $table)
    {
        $categories = Category::all();

        return view('orders.index', compact('table', 'categories'));
    }

    public function order()
    {
        Cart::truncate();

        return redirect('/tables');
    }
}
