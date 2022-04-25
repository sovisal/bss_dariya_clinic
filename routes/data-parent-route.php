<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataParentController;

Route::middleware(['auth'])->name('setting.')->group(function () {
	Route::prefix('data-parent')->group(function () {
		Route::get('/', [DataParentController::class, 'index'])->name('data-parent.index');
		Route::get('/create', [DataParentController::class, 'create'])->name('data-parent.create');
		Route::put('/store', [DataParentController::class, 'store'])->name('data-parent.store');
		Route::get('/{dataParent}/edit', [DataParentController::class, 'edit'])->name('data-parent.edit');
		Route::put('/{dataParent}/update', [DataParentController::class, 'update'])->name('data-parent.update');
		Route::delete('/{dataParent}/delete', [DataParentController::class, 'destroy'])->name('data-parent.delete');
	});
});