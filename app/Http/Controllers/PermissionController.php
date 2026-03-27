<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Inertia\Inertia;

class PermissionController extends Controller
{
    public function index(Request $request){
        $permissions = Permission::get();
        return Inertia::render('Permission/Index',[
            'permissions'=>$permissions
        ]);
    }

    public function createPermission(Request $request){
        $request->validate([
            'name'=>['required']
        ]);
        Permission::create([
            'name'=>$request->name
        ]);
        return to_route("permission.index");
    }
    public function createPermissionInterface(Request $request){
        return Inertia::render('Permission/CreatePermissionInterface');
    }
    public function editPermission(Request $request,$id){
        $permission = Permission::find($id);
        return Inertia::render('Permission/Edit',[
            'permission'=>$permission
        ]);
    }

    public function updatePermission(Request $request,$id){
        $request->validate([
            'name'=>['required']
        ]);
        $permission = Permission::find($id);
        $permission->name = $request->name;
        return to_route("permission.index");
    }
    public function assignInstitutionPermission(Request $request){

    }
}
