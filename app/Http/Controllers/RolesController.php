<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return Inertia::render('Roles/Index',[
            'roles'=> Role::with('permissions')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::pluck('name')->all();
        return Inertia::render('Roles/Create',[
            'permissions'=> $permissions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>['required'],
            'perms'=>['required']
        ]);
        $role = Role::create(['name'=>$request->name]);
        $role->syncPermissions($request->perms);
        return to_route("roles.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::find($id);
        $permissions = Permission::pluck('name')->all();
        return Inertia::render('Roles/Edit', [
            'role'=>$role,
            'permissions' => $permissions,
            'rolePermissions'=>$role->permissions()->pluck("name")->all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'name' => ['required'],
            'perms' => ['required']
        ]);
        $role = Role::find($id);
        $role->name= $request->name;
        $role->syncPermissions($request->perms);
        return to_route("roles.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
