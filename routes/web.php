<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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


	require __DIR__.'/patient-route.php';
	require __DIR__.'/user-route.php';
	require __DIR__.'/address-route.php';
