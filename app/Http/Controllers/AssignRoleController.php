<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AssignRoleController extends Controller
{
    public function assignRole($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('users.assign',compact('user','roles'));
    }
    public function assign(Request $request)
    {
        $user = User::findOrFail($request->id);
        
        $role = Role::findOrFail($request->role);
        $assign = $user->roles()->sync([$role->id => ['model_type' => 'App\\Models\\User']]);
        

        return redirect('/users');
    }
}
