<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\CustomerDiscount;
use App\Models\DinningPlan;
use App\Models\Discount;
use App\Models\Kitchen;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Recipe;
use App\Models\SaleRecord;
use App\Models\Taste;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Rawilk\Printing\Facades\Printing;
use Yajra\DataTables\DataTables;

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

        $check_order = Order::where('dinning_plan', $table->name)->where('status', 'ordered')->first();

        if($check_order && $check_order->status == 'ordered')
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
                    'status' => 'ordered',
                    'order_date' => Carbon::now()
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
                    'status' => 'ordered',
                    'order_date' => Carbon::now()
                ]);

                $order_id = $order->id;
            }

            if($search_discount == null && $search_customer_discount == null)
            {
                $order = Order::create([
                    'total_amount' => $total,
                    'dinning_plan' => $table->name,
                    'status' => 'ordered',
                    'order_date' => Carbon::now()
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
                ]);
    
                $order_detail->recipes()->sync($item->recipe_id);
            }
    
        }

        $table->update([
            'status' => 'reserved'
        ]);

        foreach($items as $item)
        {
           $kitchen_id = Recipe::where('id', $item->recipe_id)->value('kitchen_id');
           foreach($item->recipes as $recipe)
           {
                $recipe_name = $recipe->name;
           }
           $data = [
                'recipe_name' => $recipe_name,
                'quantity' => $item->quantity,
                'taste' => $item->taste
            ];

            $pdf = Pdf::loadView('receipt.print-order', $data);

            $filename = 'receipt_' . time() . '.pdf';

            $pdf->save(public_path('pdfs/' . $filename));

            if($kitchen_id == 1)
            {
                $filePath = public_path('pdfs/' . $filename);
                Printing::newPrintTask()
                ->printer('ipp://localhost:631/printers/CUPS-BRF')
                ->file($filePath)
                ->send();
            }


            
        }

 

        $cart_items->delete();

        return redirect('/order-list');
    }

    public function list(Request $request)
    {
        if($request->ajax()){
            $orders = Order::where('status', 'ordered')->orderBy('id', 'desc')->get();
            return DataTables::of($orders)
            ->addColumn('action',function($each){
                $detail_icon = '<a href="'.route('order.detail',$each->id).'" class="btn btn-outline-primary" style="margin-right:10px;"><i class="fas fa-eye"></i>&nbsp;Details</a>';

                return '<div class="action-icon">' . $detail_icon . '</div>';
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        
        return view('orders.order-list');
    }

    public function detail(Order $order)
    {
        $details = $order->order_details()->with('recipes')->get();

        if($order->status == 'paid')
        {
            return redirect('/dinning-plans');
        }   
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

    public function checkout(Order $order)
    {
        if($order->status == 'ordered')
        {
            $total = $order->total_amount + ($order->total_amount * 0.1);

            $discount_amount = 0;
            
            $discount_search = Discount::where('id', $order->discount_id)->with('categories')->first();
            if($discount_search)
            {
                $discount_amount = $total - ($total * ($discount_search->percent / 100));
            } 
    
            $customer_discount_search = CustomerDiscount::where('id', $order->customer_discount_id)->value('percent');
            if($customer_discount_search)
            {
                $discount_amount = $total - ($total * ($customer_discount_search / 100));
            } 
            if(!$discount_search && !$customer_discount_search)
            {
                $discount_amount = $total;
            }
    
            $record = SaleRecord::create([
                'order_id' => $order->id,
                'amount' => $total,
                'discounted_amount' => $discount_amount,
                'order_date' => $order->order_date
            ]);
    
            $order->update([
                'status' => 'paid'
            ]);

            $table = DinningPlan::where('name', $order->dinning_plan)->first();

            $table->update([
                'status' => 'available'
            ]);
    
            return redirect()->route('print.receipt', $record->id);
        }
        else
        {
            return redirect('/dinning-plans')->with('error', "Error");
        }

    }
}
