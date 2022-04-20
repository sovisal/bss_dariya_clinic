<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;

Route::middleware(['auth'])->name('setting.')->group(function () {
	Route::prefix('doctor')->name('doctor.')->group(function () {
		Route::get('/', [DoctorController::class, 'index'])->name('index');
		Route::get('/create', [DoctorController::class, 'create'])->name('create')->middleware('can:CreateDoctor');
		Route::post('/store', [DoctorController::class, 'store'])->name('store')->middleware('can:CreateDoctor');
		Route::get('/{doctor}/edit', [DoctorController::class, 'edit'])->name('edit')->middleware('can:UpdateDoctor');
		Route::put('/{doctor}/update', [DoctorController::class, 'update'])->name('update')->middleware('can:UpdateDoctor');
		Route::delete('/{doctor}/delete', [DoctorController::class, 'destroy'])->name('delete')->middleware('can:DeleteDoctor');
		Route::get('/{doctor}/show', [DoctorController::class, 'show'])->name('show')->middleware('can:ViewAnyDoctor');
		Route::post('/getSelect2', [DoctorController::class, 'getSelect2'])->name('getSelect2');
	});
});