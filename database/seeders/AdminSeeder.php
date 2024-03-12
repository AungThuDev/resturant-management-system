<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password')
        ]);

        $role = Role::create([
            'name' => 'admin'
        ]);

         //$user->assignRole($roles);
         $admin->roles()->sync([$role->id => ['model_type' => 'App\\Models\\User']]);


         $permissions = ['user-management', 'menu-management', 'order-management', 'reporting', 'setting', 'discount-management'];
         $permission = [];
         foreach ($permissions as $p) {
             array_push($permission, Permission::create(['name' => $p]));
         }
 
         $role->syncPermissions($permission);
    }
}
