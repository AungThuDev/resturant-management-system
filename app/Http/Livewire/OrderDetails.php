<?php

namespace App\Http\Livewire;

use App\Models\CustomerDiscount;
use App\Models\Discount;
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
        $discount_search = Discount::where('name', $this->discount)->first();
        
        if($discount_search)
        {
            $this->discounted_total = $this->total - ($this->total * ($discount_search->percent / 100));
            $this->order->update([
                'discount_id' => $discount_search->id,
                'customer_discount_id' => null
            ]);
        }

        $customer_discount_search = CustomerDiscount::where('name', $this->discount)->first();

        if($customer_discount_search)
        {
            $this->discounted_total = $this->total - ($this->total * ($customer_discount_search->percent / 100));
            $this->order->update([
                'discount_id' => null,
                'customer_discount_id' => $customer_discount_search->id
            ]);
        }

        if(!$discount_search && !$customer_discount_search)
        {
            $this->discounted_total = $this->total;
            $this->order->update([
                'discount_id' => null,
                'customer_discount_id' => null
            ]);
        }

        return view('livewire.order-details', ['details' => $this->details,'discounted_total' => $this->discounted_total]);

    }

}
