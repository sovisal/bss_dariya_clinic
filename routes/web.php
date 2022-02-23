<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
	Route::get('/', [HomeController::class, 'index'])->name('home');
	Route::get('/git_pull', [HomeController::class, 'git_pull'])->name('git_pull');

	Route::get('/setting', [HomeController::class, 'setting'])->name('setting.edit');
	Route::put('/setting/update', [HomeController::class, 'setting_update'])->name('setting.update');
});

	require __DIR__.'/user-route.php';
