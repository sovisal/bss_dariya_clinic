<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ConsultationController;

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

Route::middleware(['auth'])->prefix('patient')->name('patient.')->group(function () {

	Route::get('/', [PatientController::class, 'index'])->name('index')->middleware('can:ViewAnyPatient');
	Route::get('/create', [PatientController::class, 'create'])->name('create')->middleware('can:CreatePatient');
	Route::post('/store', [PatientController::class, 'store'])->name('store')->middleware('can:CreatePatient');
	Route::get('/{patient}/edit', [PatientController::class, 'edit'])->name('edit')->middleware('can:UpdatePatient');
	Route::put('/{patient}/update', [PatientController::class, 'update'])->name('update')->middleware('can:UpdatePatient');
	Route::delete('/{patient}/delete', [PatientController::class, 'destroy'])->name('delete')->middleware('can:DeletePatient');

	Route::get('/consultation/{patient}/create', [ConsultationController::class, 'create'])->name('consultation_create')->middleware('can:CreateConsultation');

});


	require __DIR__.'/user-route.php';
	require __DIR__.'/address-route.php';
