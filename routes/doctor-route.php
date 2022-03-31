<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;

Route::middleware(['auth'])->name('setting.')->group(function () {
	Route::prefix('doctor')->group(function () {
		Route::get('/', [DoctorController::class, 'index'])->name('doctor.index');
	});
});