<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    protected $fillable = ['name','percent'];

    public function categories()
    {
        return $this->belongsToMany(Category::class,'category_discount');
    }
}
