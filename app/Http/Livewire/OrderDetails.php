<?php

namespace App\Http\Livewire;

use App\Models\CustomerDiscount;
use App\Models\Discount;
use App\Models\OrderDetail;
use App\Models\Recipe;
use Livewire\Component;

class OrderDetails extends Component
{
    public $details;

    public $order;

    public $discount_name;

    public $total;

    public $discount;

    public $discounted_total;


    public function mount()
    {
        $this->discount = $this->discount_name;
    }

    public function render()
    {
        $order_details = $this->details;

        $total = $this->total + ($this->total * 0.1);

        $discount_search = Discount::where('name', $this->discount)->first();

        $total_for_category_discount = 0;

        if($discount_search)
        {   
            foreach ($order_details as $order_detail) {
    
                foreach ($order_detail->recipes as $recipe) {
                    $discount = $discount_search->categories->find($recipe->category_id);
                    $recipe_price = OrderDetail::where('order_id', $this->order->id)->where('recipe_id', $recipe->id)->value('amount');

                    if ($discount) {
                        $percent = $discount_search->percent;
                        $discounted_price = $recipe_price - ($recipe_price * ($percent / 100));
                        $total_for_category_discount += $discounted_price;
                    } else {
                        $total_for_category_discount += $recipe_price;
                    }
                }
            }
    
            $this->discounted_total = $total_for_category_discount + ($total_for_category_discount * 0.1);
    
            $this->order->update([
                'discount_id' => $discount_search->id,
                'customer_discount_id' => null
            ]);
        }   


        $customer_discount_search = CustomerDiscount::where('name', $this->discount)->first();

        if($customer_discount_search)
        {
            $this->discounted_total = $total - ($total * ($customer_discount_search->percent / 100));
            $this->order->update([
                'discount_id' => null,
                'customer_discount_id' => $customer_discount_search->id
            ]);
        }

        if(!$discount_search && !$customer_discount_search)
        {
            $this->discounted_total = $total;
            $this->order->update([
                'discount_id' => null,
                'customer_discount_id' => null
            ]);
        }

        return view('livewire.order-details', ['details' => $this->details,'discounted_total' => $this->discounted_total, 'order' => $this->order]);

    }

}
