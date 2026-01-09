<?php

use App\Http\Controllers\RolesController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;


Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::resource('users',UserController::class);
// Route::resource('users',UserController::class)->only(['create','store',])->middleware("permission:users.create");

// Route::resource('roles',RolesController::class);
// Route::resource('roles',RolesController::class)->only(['create','store',])->middleware("permission:roles.create");
// Route::resource('roles',RolesController::class)->only(['edit',])->middleware("permission:roles.edit");

Route::resource('roles', RolesController::class)->middleware([
    'create'  => 'permission:roles.create',
    'store'   => 'permission:roles.create',
    'edit'    => 'permission:roles.edit',
    'update'  => 'permission:roles.edit',
    'destroy' => 'permission:roles.delete',
]);

Route::resource('users', UserController::class)->middleware([
    'create' => 'permission:users.create',
    'store'  => 'permission:users.create',
    'edit'   => 'permission:users.edit',
    'update' => 'permission:users.edit',
]);


Route::get('index/create2/user',[UserController::class,'indexCreate2User'])->name('index.create2.user');
Route::post('save/create2/user',[UserController::class,'saveCreate2User'])->name('save.create2.user');
Route::get('edit-user2/{id}',[UserController::class,'editUser2'])->name('edit.user2');
Route::put('update-user2/{id}',[UserController::class,'updateUser2'])->name('update.user2');

Route::get('permission-index',[PermissionController::class,'index'])->name('permission.index');
Route::post('create-permission',[PermissionController::class,'createPermission'])->name('create.permission');
Route::get('create-permission-interface',[PermissionController::class,'createPermissionInterface'])->name('create.permission.interface');
Route::get('edit-permission/{id}',[PermissionController::class,'editPermission'])->name('edit.permission');
Route::post('delete-permission',[PermissionController::class,'deletePermission'])->name('delete.permission');
Route::post('update-permission/{id}',[PermissionController::class,'updatePermission'])->name('update.permission');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
