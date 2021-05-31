<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function createRole(Request $request){
        $validatedData = $request->validate([
            'role' => 'required|unique:roles',
            'info' => 'required'
        ]);
        Role::create($validatedData);
        return response(['status'=>'Role created']);
    }
    public function assignRole(Request $request){
        User::find($request->user_id)->update(['role_id'=>$request->role_id]);
        return response(['status'=>'User role updated']);
    }
    public function deleteRole(Request $request){
        User::find($request->user_id)->update(['role_id'=>5]);
        return response(['status'=>'User role deleted']);
    }
}
