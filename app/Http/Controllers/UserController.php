<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $user = User::with('roles')->get();
            return DataTables::of($user)
            ->addColumn('action',function($each){ 
                if($each->roles->isNotEmpty()){
                    $edit_icon = '<a href="'.route('users.edit',$each->id).'" class="btn btn-outline-warning" style="margin-right:10px;"><i class="fas fa-user-edit"></i>&nbsp;Edit</a>';
                    $role = '<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModal' . $each->id . '"><i class="fas fa-eye"></i>&nbsp;Role&Permission</button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal' . $each->id . '" tabindex="-1" aria-labelledby="exampleModalLabel' . $each->id . '" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel' . $each->id . '">'.$each->name.'</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h6>Role Name</h6><br>
                            <ul>';
            foreach ($each->roles as $roleItem) {
                $role .= '<li>' . $roleItem->name . '</li>';
            }
            $role .= '</ul><br>
                            <h6>Permission Name</h6><br>
                            <ul>';
            foreach ($each->roles as $roleItem) {
                foreach ($roleItem->permissions as $permission) {
                    $role .= '<li>' . $permission->name . '</li>';
                }
            }
            $role .= '</ul><br>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>';
                    $assign = '';
                }else{
                    $assign = '<a href="'.route('users.assign',$each->id).'" class="btn btn-outline-success" style="margin-right:10px;"><i class="fas fa-user-edit"></i>&nbsp;AssignPermission</a>';
                    $edit_icon = '';
                    $role = '';
                }
                
                
                $delete_icon = '<a href="" class="btn btn-outline-danger delete" data-id = "'.$each->id.'"><i class="fas fa-trash-alt"></i>&nbsp;Delete</a>';

            
           
                return '<div class="action-icon">' . $role .$assign. $edit_icon . $delete_icon . '</div>';
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('users.index');
    }
    public function create()
    {
        return view('users.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed'
        ]);

        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);

        return redirect('/users')->with('User Created Successfully');
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $permissions = Permission::all();
        return view('users.edit',compact('user','roles','permissions'));
    }

    public function showAssign($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $permissions = Permission::all();
        return view('users.assign',compact('user','roles','permissions'));
    }
    public function assign(Request $request)
    {
        $user = User::findOrFail($request->id);
        $role = Role::findOrFail($request->id);

        $user->roles()->sync([$role->id => ['model_type' => 'App\\Models\\User']]);

        $permissions = $request->permissions ?? [];
        $role->syncPermissions($permissions);

        return redirect('/users');
    }
    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return 'success';
    }
}
