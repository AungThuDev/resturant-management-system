<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function assignPermission(Request $request,$roleId)
    {        
        $role = Role::find($roleId); 
        if ($role) {
            $permissions = $request->permissions; // Assuming $request->permissions is an array of permission IDs
            $syncResult = $role->syncPermissions($permissions);
        } else {

            dd('Role not found');
        }
        return redirect('/roles')->with('create','Role & Permission created successfully');
    }
    

    public function updatePermission(Request $request,$roleId)
    {
        

        // Retrieve the selected role
        $role = Role::findOrFail($roleId);
        
        

        $role->update([
            "name" => $request->name
        ]);
        
        // Update the user's assigned permissions
        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        } else {
            // If no permissions are selected, remove all permissions from the user
            $role->syncPermissions([]);
        }

        // Redirect the user back to the desired page or return a response
        return redirect('/roles')->with('update', 'Role & permissions updated successfully.');
    }
}

