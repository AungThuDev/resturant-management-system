<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Recipe;
use App\Models\Kitchen;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $userData = User::count();
    $categoryData = Category::count();
    $recipeData = Recipe::count();
    $kitchenData = Kitchen::count();

    return view('dashboard.index', compact('userData', 'categoryData', 'recipeData', 'kitchenData'));
    }
}
