<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DinningPlan extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status'];

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
