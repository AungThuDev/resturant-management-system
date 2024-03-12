<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\DataTables\DataTables;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $role = Role::query();
            return DataTables::of($role)
            ->addColumn('permission',function($each){
                $permission = '';
                if ($each->permissions->isNotEmpty()) {
                    $permission = '<button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#exampleModal' . $each->id . '"><i class="fas fa-eye"></i>&nbsp;ViewPermission</button>
                    <!-- Modal -->
                <div class="modal fade" id="exampleModal' . $each->id . '" tabindex="-1" aria-labelledby="exampleModalLabel' . $each->id . '" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Role Name = </h5><br>
                                <h5 class="modal-title" id="exampleModalLabel' . $each->id . '">'.$each->name.'</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h5>Permissions</h5><br>
                                <ul>';
                                foreach($each->permissions as $p){
                                    $permission .= '<li>' . $p->name . '</li>';
                                }
                                $permission .= '</ul><br>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>'; 
                } else {
                    $permission .= '<span>No Permissions Found</span>';
                }
                
                return '<div class="action-icon">' . $permission .  '</div>';

                
            })
            ->addColumn('action',function($each){
                if($each->permissions->isNotEmpty()){
                    $update = '<a href="'.route('roles.editAssign',$each->id).'" class="btn btn-outline-dark" style="margin-right:10px;"><i class="fas fa-edit"></i>&nbsp;UpdatePermission</a>';
                    $assign = '';
                }else{
                    $assign = '<a href="'.route('roles.assign',$each->id).'" class="btn btn-outline-primary" style="margin-right:10px;"><i class="fas fa-edit"></i>&nbsp;AssignPermission</a>';
                    $update = '';
                }
                
                
                $delete_icon = '<a href="" class="btn btn-outline-danger delete" data-id = "'.$each->id.'"><i class="fas fa-trash-alt"></i>&nbsp;Delete</a>';

                return '<div class="action-icon">' . $assign . $update . $delete_icon . '</div>';
            })
            ->rawColumns(['permission','action'])
            ->make(true);
        }
        return view('roles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.create');
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
        ]);
        Role::create([
            "name" => $request->name,
        ]);

        return redirect('/roles')->with('create','Create Role Successfully');
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
        $role = Role::findOrFail($id);
        return view('roles.edit',compact('role'));
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
        $role = Role::findOrFail($id);
        $request->validate([
            "name" => "required"
        ]);
        $role->update([
            "name" => $request->name
        ]);

        return redirect('/roles')->with('update','Role Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return 'success';
    }

    public function assignForm($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('roles.assign',compact('role','permissions'));
    }
    public function editAssign($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('roles.editPermission',compact('role','permissions'));
    }
}
