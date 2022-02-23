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

Route::middleware(['auth'])->get('/', [HomeController::class, 'index'])->name('home');
Route::middleware(['auth'])->get('/git_pull', [HomeController::class, 'git_pull'])->name('git_pull');

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {


});

	require __DIR__.'/user-route.php';
