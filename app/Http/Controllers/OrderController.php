<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\CustomerDiscount;
use App\Models\DinningPlan;
use App\Models\Discount;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Recipe;
use App\Models\Taste;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Ramsey\Uuid\v1;

class OrderController extends Controller
{
    public function index(DinningPlan $table)
    {
        $categories = Category::all();
        $tastes = Taste::all();

        return view('orders.index', compact('table', 'categories', 'tastes'));
    }

    public function order(DinningPlan $table)
    {

        $cart_items = Cart::where('dinning_plan_id', $table->id)->with('dinning_plan');

        $items = $cart_items->get();

        $total = 0;

        $order_id = 0;

        foreach($items as $item)
        {
            $total += $item->price;  
        }

        $check_order = Order::where('dinning_plan', $table->name)->first();

        if($check_order)
        {
            if(request()->discount_name)
            {
                $search_discount = Discount::where('name', request()->discount_name)->first();

                if($search_discount)
                {
                    $check_order->update([
                        'total_amount' => DB::raw("total_amount + {$total}"),
                        'discount_id' => $search_discount->id,
                        'customer_discount_id' => null,
                    ]);
                }

                $search_customer_discount = CustomerDiscount::where('name', request()->discount_name)->first();

                if($search_customer_discount)
                {
                    $check_order->update([
                        'total_amount' => DB::raw("total_amount + {$total}"),
                        'discount_id' => null,
                        'customer_discount_id' => $search_customer_discount->id
                    ]);
                }

            }

            else
            {
                $check_order->update([
                    'total_amount' => DB::raw("total_amount + {$total}"),
                    'discount_id' => null,
                    'customer_discount_id' => null
                ]);
            }

            $order_id = $check_order->id;
        }
        else
        {
            $search_discount = Discount::where('name', request()->discount_name)->first();

            if($search_discount)
            {
                $order = Order::create([
                    'total_amount' => $total,
                    'dinning_plan' => $table->name,
                    'discount_id' => $search_discount->id,
                    'customer_discount_id' => null,
                    'status' => 'ordered'
                ]);

                $order_id = $order->id;
            }
    
            $search_customer_discount = CustomerDiscount::where('name', request()->discount_name)->first();
            
            if($search_customer_discount)
            {
                $order = Order::create([
                    'total_amount' => $total,
                    'dinning_plan' => $table->name,
                    'discount_id' => null,
                    'customer_discount_id' => $search_customer_discount->id,
                    'status' => 'ordered'
                ]);

                $order_id = $order->id;
            }

            if($search_discount == null && $search_customer_discount == null)
            {
                $order = Order::create([
                    'total_amount' => $total,
                    'dinning_plan' => $table->name,
                    'status' => 'ordered'
                ]);

                $order_id = $order->id;
            }

            
        }

        foreach($items as $item)
        {

            $check_detail = OrderDetail::where('order_id', $order_id)->where('recipe_id', $item->recipe_id)->where('taste', $item->taste)->first();


            if($check_detail)
            {
                $check_detail->update([
                    'amount' => DB::raw("amount + {$item->price}"),
                    'quantity' => DB::raw("quantity + {$item->quantity}")
                ]);
            }
            else
            {
                $order_detail = OrderDetail::create([
                    'order_id' => $order_id,
                    'user_id' => 1,
                    'recipe_id' => $item->recipe_id,
                    'taste' => $item->taste,
                    'amount' => $item->price,
                    'quantity' => $item->quantity,
                    'order_date' => Carbon::now()
                ]);
    
                $order_detail->recipes()->sync($item->recipe_id);
            }
    
        }

        $table->update([
            'status' => 'reserved'
        ]);

        $cart_items->delete();

        return redirect('/order-list');
    }

    public function list()
    {
        $orders = Order::where('status', 'ordered')->orderBy('id', 'desc')->paginate(5);


        return view('orders.order-list', compact('orders'));
    }

    public function detail(Order $order)
    {
        $details = $order->order_details()->with('recipes')->get();

        $discount_name = '';

        $total = 0;

        foreach($details as $detail)
        {
            $total += $detail->amount;
        }

        $discount = Discount::where('id', $order->discount_id)->first();

        if($discount)
        {
            $discount_name = $discount->name;
        }

        $customer_discount = CustomerDiscount::where('id', $order->customer_discount_id)->first();

        if($customer_discount)
        {
            $discount_name = $customer_discount->name;
        }

        
        return view('orders.order-details', compact('details', 'total', 'discount_name', 'order'));
    }
}
