<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleRecord extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'amount', 'discounted_amount', 'order_date'];
}
