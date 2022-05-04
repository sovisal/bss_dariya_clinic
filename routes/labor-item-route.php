<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaborItemController;

Route::middleware(['auth'])->name('setting.')->group(function () {
	Route::prefix('labor-item')->group(function () {
		Route::get('/', [LaborItemController::class, 'index'])->name('labor-item.index');
		Route::get('/create', [LaborItemController::class, 'create'])->name('labor-item.create');
		Route::put('/store', [LaborItemController::class, 'store'])->name('labor-item.store');
		Route::get('/{laborItem}/edit', [LaborItemController::class, 'edit'])->name('labor-item.edit');
		Route::put('/{laborItem}/update', [LaborItemController::class, 'update'])->name('labor-item.update');
		Route::delete('/{laborItem}/delete', [LaborItemController::class, 'destroy'])->name('labor-item.delete');
	});
});