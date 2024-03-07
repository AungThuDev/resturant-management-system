<?php

namespace App\Http\Controllers;

use App\Models\CustomerDiscount;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CustomerDiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $kitchen = CustomerDiscount::query();
            return DataTables::of($kitchen)
            
            ->addColumn('action',function($each){
                $edit_icon = '<a href="'.route('customers.edit',$each->id).'" class="btn btn-outline-warning" style="margin-right:10px;"><i class="fas fa-user-edit"></i>&nbsp;Edit</a>';
                $delete_icon = '<a href="" class="btn btn-outline-danger delete" data-id = "'.$each->id.'"><i class="fas fa-trash-alt"></i>&nbsp;Delete</a>';

                return '<div class="action-icon">' . $edit_icon . $delete_icon . '</div>';
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('customers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
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
            "percent" => "required"
        ]);
        CustomerDiscount::create([
            "name" => $request->name,
            "percent" => $request->percent
        ]);

        return redirect('/customers')->with('create','CustomerDiscount Created Successfully');
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
        $cus = CustomerDiscount::findOrFail($id);
        return view('customers.edit',compact('cus'));
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
        $cus = CustomerDiscount::findOrFail($id);
        $request->validate([
            "name" => "required",
            "percent" => "required",
        ]);
        $cus->update([
            "name" => $request->name,
            "percent" => $request->percent
        ]);

        return redirect('/customers')->with('update','CustomerDiscount Updtated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cus = CustomerDiscount::findOrFail($id);
        $cus->delete();

        return 'success';
    }
}
