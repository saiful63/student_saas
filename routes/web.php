<?php

use App\Http\Controllers\RolesController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('users',UserController::class)->only(['create','store','index'])->middleware("permission:users.create");
Route::resource('roles',RolesController::class);
Route::resource('roles',RolesController::class)->only(['index'])->middleware("permission:roles.index");
Route::resource('roles',RolesController::class)->only(['create','store',])->middleware("permission:roles.create");

Route::get('index/create2/user',[UserController::class,'indexCreate2User'])->name('index.create2.user');
Route::post('save/create2/user',[UserController::class,'saveCreate2User'])->name('save.create2.user');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
