<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['recipe_id', 'price', 'quantity', 'dinning_plan_id', 'taste'];

    public function dinning_plan()
    {
        return $this->belongsTo(DinningPlan::class);
    }

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, 'cart_recipe');
    }
}
