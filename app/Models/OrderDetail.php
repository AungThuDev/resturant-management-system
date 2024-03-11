<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'customer_discount_id', 'user_id', 'recipe_id', 'taste', 'amount', 'quantity'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, 'order_details_recipe');
    }
}
