<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Discount;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryDiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $cat = Discount::with('categories')->get();
            return DataTables::of($cat)
            ->addColumn('action', function ($discount) {
                $view = '<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModal' . $discount->id . '"><i class="fas fa-eye"></i>&nbsp;View Category</button>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal' . $discount->id . '" tabindex="-1" aria-labelledby="exampleModalLabel' . $discount->id . '" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel' . $discount->id . '">'.$discount->name.'</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <ul>';
                foreach ($discount->categories as $category) {
                    $view .= '<li>' . $category->name . '</li>';
                }
                $view .= '</ul>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                
                            </div>
                        </div>
                    </div>
                </div>';
                $edit_icon = '<a href="' . route('categoryDiscounts.edit', $discount->id) . '" class="btn btn-outline-warning" style="margin-right:10px;"><i class="fas fa-user-edit"></i>&nbsp;Edit</a>';
                $delete_icon = '<a href="" class="btn btn-outline-danger delete" data-id="' . $discount->id . '"><i class="fas fa-trash-alt"></i>&nbsp;Delete</a>';

                return '<div class="action-icon">' . $view . $edit_icon . $delete_icon . '</div>';
            })
            ->rawColumns(['action'])
                ->make(true);
        }
        return view('categoryDiscounts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('categoryDiscounts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "percent" => "required",
        ]);

        $catDiscount = Discount::create([
            "name" => $request->name,
            "percent" => $request->percent,
        ]);

        $discount = Discount::find($catDiscount->id);
        $discount->categories()->sync($request->categories);

        return redirect('/categoryDiscounts')->with('create', 'CategoryDiscount Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $catDiscounts = Discount::findOrFail($id);
        return view('categoryDiscounts.edit',compact('catDiscounts','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $catDiscount = Discount::findOrFail($id);
        $request->validate([
            "name" => "required",
            "percent" => "required",
        ]);

        $catDiscount->update([
            "name" => $request->name,
            "percent" => $request->percent
        ]);

        $catDiscount->categories()->sync($request->categories);
        return redirect('/categoryDiscounts')->with('update', 'CategoryDiscount Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $catDiscount = Discount::findOrFail($id);
        $catDiscount->delete();
        return 'success';
    }
}
