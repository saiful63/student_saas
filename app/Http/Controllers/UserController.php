<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('User/Index', [
            'users' => User::with('roles')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('User/Create',[
            'roles'=>Role::pluck('name')->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>['required'],
            'email'=>['required'],
            'password'=>['required']
        ]);
        $user = User::create(
            $request->only(['name','email'])+['password'=>Hash::make($request->password)]
        );
        $user->syncRoles($request->roles);
        return to_route("users.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Inertia::render('User/Show',[
            'user'=>User::find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return Inertia::render('User/Edit',[
            'user'=>User::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required'],
        ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password){
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return to_route("users.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::destroy($id);
        return to_route("users.index");
    }

    public function indexCreate2User(){
        return Inertia::render('User2/Create',[
            'permissions'=>Permission::pluck('name')->all()
        ]);
    }

    public function saveCreate2User(Request $request){
        $request->validate([
            'name'=>['required'],
            'email'=>['required'],
            'password'=>['required']
        ]);
        $user = User::create(
            $request->only(['name','email'])+['password'=>Hash::make($request->password)]
        );
        
        $user->givePermissionTo($request->selectedPermission);
        return to_route("users.index");
    }
}
