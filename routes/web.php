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

});


require __DIR__.'/patient-route.php';
require __DIR__.'/prescription-route.php';
require __DIR__.'/para-clinic-route.php';
require __DIR__.'/user-route.php';
require __DIR__.'/setting-route.php';
require __DIR__.'/data-parent-route.php';
require __DIR__.'/labor-item-route.php';
require __DIR__.'/echo-type-route.php';
require __DIR__.'/xray-type-route.php';
require __DIR__.'/ecg-type-route.php';
require __DIR__.'/echography-route.php';
require __DIR__.'/xray-route.php';
require __DIR__.'/ecg-route.php';
require __DIR__.'/labor-route.php';