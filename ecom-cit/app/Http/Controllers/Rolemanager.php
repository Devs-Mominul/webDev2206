<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Rolemanager extends Controller
{
   function role_manager(){
    $permissions=Permission::all();
    $roles=Role::all();
    $users=User::all();
    return view('role.role',[
        'permissions'=>$permissions,
        'roles'=>$roles,
        'users'=>$users
    ]);
   }
   function role_post(Request $request){
    Permission::create(['name' =>$request->permission_name]);
    return back();

   }
   function role_manager_post(Request $request){
    $role=Role::create(['name' =>$request->role_name]);
    $role->givePermissionTo($request->permission_id);
    return back();

   }
   function assign_role(Request $request){
    $user=User::find($request->user_id);
    $user->assignRole($request->role);
   }
   function user_assign_remove($id){
    $user=User::find($id);
    $user->syncRoles([]);

   }
}
