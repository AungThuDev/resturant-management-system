<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function assignPermission(Request $request,$id)
    {        
        // Find the user and role
        $user = User::where('name',$request->name)->first();
    
        $role = Role::find($request->role);
        
    
        // Assign the role to the user
        $user->roles()->sync([$role->id => ['model_type' => 'App\\Models\\User']]);
        
        // Sync permissions for the role
        $role->syncPermissions($request->permissions);
    
        // Redirect back to the users page
        return redirect('/users');
    }
    

    public function updateAssign(Request $request, $userId)
    {
        // Validate the incoming request data
        $request->validate([
            // 'role' => 'required|exists:roles,id',
            // 'permissions' => 'array',
            // Add any additional validation rules as needed
        ]);

        // Retrieve the user
        $user = User::findOrFail($userId);

        // Retrieve the selected role
        $role = Role::findOrFail($request->role);

        // Update the user's assigned role(s)
        $user->roles()->sync([$role->id => ['model_type' => 'App\\Models\\User']]);

        // Update the user's assigned permissions
        if ($request->has('permissions')) {
            $permissions = Permission::whereIn('id', $request->permissions)->get();
            $role->syncPermissions($permissions);
        } else {
            // If no permissions are selected, remove all permissions from the user
            $role->syncPermissions([]);
        }

        // Redirect the user back to the desired page or return a response
        return redirect('/users')->with('update', 'Role and permissions updated successfully.');
    }
}

