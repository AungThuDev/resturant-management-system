<?php

namespace App\Http\Controllers;

use App\Models\DinningPlan;
use Illuminate\Http\Request;

class DinningPlanController extends Controller
{
    public function index()
    {
        $tables = DinningPlan::all();

        return view('dinning-plans.index', compact('tables'));
    }
}
