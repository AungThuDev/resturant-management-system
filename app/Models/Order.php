<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['total_amount', 'dinning_plan', 'status', 'customer_discount_id', 'discount_id', 'order_date'];

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
