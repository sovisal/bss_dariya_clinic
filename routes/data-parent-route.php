<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataParentController;

Route::middleware(['auth'])->name('setting.')->group(function () {
	Route::prefix('data-parent')->group(function () {
		Route::get('/', [DataParentController::class, 'index'])->name('data-parent.index');
		Route::get('/{dataParent}/edit', [DataParentController::class, 'edit'])->name('data-parent.edit');
		Route::put('/{dataParent}/update', [DataParentController::class, 'update'])->name('data-parent.update');
	});
});