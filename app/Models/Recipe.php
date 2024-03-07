<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    protected $fillable = ['name','price','image','category_id','kitchen_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function kitchen()
    {
        return $this->belongsTo(Kitchen::class);
    }
    public function carts()
    {
        return $this->belongsToMany(Cart::class);
    }

    public function order_details()
    {
        return $this->belongsToMany(OrderDetail::class);
    }
}
