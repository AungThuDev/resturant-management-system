<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Kitchen;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $recipe = Recipe::query();
            return DataTables::of($recipe)
            ->editColumn('image', function ($each) {
                return '<img src="' . asset("/images/" . $each->image) . '" class="img-thumbnail" width="100" height="100"/>';
            })
            ->editColumn('category_id',function($each){
                return $each->category->name;
            })
            ->editColumn('kitchen_id',function($each){
                return $each->kitchen->name;
            })
            ->addColumn('action',function($each){
                $edit_icon = '<a href="'.route('recipes.edit',$each->id).'" class="btn btn-outline-warning" style="margin-right:10px;"><i class="fas fa-user-edit"></i>&nbsp;Edit</a>';
                $delete_icon = '<a href="" class="btn btn-outline-danger delete" data-id = "'.$each->id.'"><i class="fas fa-trash-alt"></i>&nbsp;Delete</a>';

                return '<div class="action-icon">' . $edit_icon . $delete_icon . '</div>';
            })
            ->rawColumns(['kitchen','category','image','action'])
            ->make(true);
        }
        
        return view('recipes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $kitchens = Kitchen::all();
        return view('recipes.create',compact('categories','kitchens'));
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
            "price" => "required",
            "category" => "required",
            "kitchen" => "required",
            "image" => "required"
        ]);

        $file = $request->file('image');
        $filename = uniqid().$file->getClientOriginalName();
        $file->move(public_path('/images'),$filename);

        Recipe::create([
            "name" => $request->name,
            "price" => $request->price,
            "image" => $filename,
            "category_id" => $request->category,
            "kitchen_id" => $request->kitchen
        ]);
        return redirect('/recipes')->with('create','Create Recipe Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $recipe = Recipe::findOrFail($id);
        $categories = Category::all();
        $kitchens = Kitchen::all();
        return view('recipes.edit',compact('recipe','categories','kitchens'));
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
        $recipe = Recipe::findOrFail($id);
        if($file = $request->file('image'))
        {
            File::delete(public_path('/images/'.$recipe->image));
            $file_name = uniqid().$file->getClientOriginalName();
            $file->move(public_path('/images'),$file_name);
        }
        else{
            $file_name = $recipe->image;
        }
        $request->validate([
            "name" => "required",
            "price" => "required",
            "category" => "required",
            "kitchen" => "required",
        ]);
        
        $recipe->update([
            "name" => $request->name,
            "price" => $request->price,
            "image" => $file_name,
            "category_id" => $request->category,
            "kitchen_id" => $request->kitchen,
        ]);
        return redirect('/recipes')->with('update','Recipe Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $recipe = Recipe::findOrFail($id);
        $recipe->delete();
        return 'success';
    }
}
