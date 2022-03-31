<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataParentController;

Route::middleware(['auth'])->name('setting.')->group(function () {
	Route::prefix('data-parent')->group(function () {
		Route::get('/', [DataParentController::class, 'index'])->name('data-parent.index');
	});
});