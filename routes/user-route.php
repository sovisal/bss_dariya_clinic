<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AbilityController;


Route::post('/checkUserID', [UserController::class, 'checkUserID'])->name('user.checkUserID');
Route::post('/deleteSelected', [HomeController::class, 'deleteSelected'])->name('deleteSelected');

Route::name('user.')->middleware(['auth'])->group(function () {

	Route::prefix('user')->group(function () {
		Route::get('/', [UserController::class, 'index'])->name('index')->middleware('can:ViewAnyUser');
		Route::get('/create', [UserController::class, 'create'])->name('create')->middleware('can:CreateUser');
		Route::post('/store', [UserController::class, 'store'])->name('store')->middleware('can:CreateUser');
		Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit')->middleware('can:UpdateUser');
		Route::put('/{user}/update', [UserController::class, 'update'])->name('update')->middleware('can:UpdateUser');
		Route::delete('/{user}/delete', [UserController::class, 'destroy'])->name('delete')->middleware('can:DeleteUser');
		Route::get('/{user}/role', [UserController::class, 'role'])->name('role')->middleware('can:AssignUserRole');
		Route::put('/{user}/assign_role', [UserController::class, 'assign_role'])->name('assign_role')->middleware('can:AssignUserRole');
		Route::get('/{user}/ability', [UserController::class, 'ability'])->name('ability')->middleware('can:AssignUserAbility');
		Route::put('/{user}/assign_ability', [UserController::class, 'assign_ability'])->name('assign_ability')->middleware('can:AssignUserAbility');
		Route::get('/{user}/password', [UserController::class, 'password'])->name('password')->middleware('can:UpdateUserPassword');
		Route::put('/{user}/update_password', [UserController::class, 'update_password'])->name('update_password')->middleware('can:UpdateUserPassword');
		Route::get('/{type}/account', [UserController::class, 'account'])->name('account');
		Route::put('/{type}/update_account', [UserController::class, 'update_account'])->name('update_account');
	});

	Route::prefix('ability')->name('ability.')->group(function () {
		Route::get('/', [AbilityController::class, 'index'])->name('index')->middleware('can:ViewAnyAbility');
		Route::get('/create', [AbilityController::class, 'create'])->name('create')->middleware('can:CreateAbility');
		Route::post('/store', [AbilityController::class, 'store'])->name('store')->middleware('can:CreateAbility');
		Route::get('/{ability_module}/edit', [AbilityController::class, 'edit'])->name('edit')->middleware('can:UpdateAbility');
		Route::put('/{ability_module}/update', [AbilityController::class, 'update'])->name('update')->middleware('can:UpdateAbility');
		Route::delete('/{ability_module}/delete', [AbilityController::class, 'destroy'])->name('delete')->middleware('can:DeleteAbility');
		Route::post('/show', [AbilityController::class, 'show'])->name('show')->middleware('can:ViewAnyAbility');
	});

	Route::prefix('role')->name('role.')->group(function () {
		Route::get('/', [RoleController::class, 'index'])->name('index')->middleware('can:ViewAnyRole');
		Route::get('/create', [RoleController::class, 'create'])->name('create')->middleware('can:CreateRole');
		Route::post('/store', [RoleController::class, 'store'])->name('store')->middleware('can:CreateRole');
		Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('edit')->middleware('can:UpdateRole');
		Route::put('/{role}/update', [RoleController::class, 'update'])->name('update')->middleware('can:UpdateRole');
		Route::delete('/{role}/delete', [RoleController::class, 'destroy'])->name('delete')->middleware('can:DeleteRole');
		Route::get('/{role}/ability', [RoleController::class, 'ability'])->name('ability')->middleware('can:AssignRoleAbility');
		Route::put('/{role}/assign_ability', [RoleController::class, 'assign_ability'])->name('assign_ability')->middleware('can:AssignRoleAbility');
	});
});