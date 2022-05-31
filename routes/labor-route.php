<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaboratoryController;

Route::middleware(['auth'])->name('para_clinic.')->group(function () {
	Route::prefix('labor')->group(function () {
		Route::get('/', [LaboratoryController::class, 'index'])->name('labor.index');
		Route::get('/create', [LaboratoryController::class, 'create'])->name('labor.create');
		Route::put('/store', [LaboratoryController::class, 'store'])->name('labor.store');
		Route::get('/{labor}/print', [LaboratoryController::class, 'print'])->name('labor.print');
		Route::get('/{labor}/edit', [LaboratoryController::class, 'edit'])->name('labor.edit');
		Route::get('/{labor}/show', [LaboratoryController::class, 'show'])->name('labor.show');
		Route::put('/{labor}/update', [LaboratoryController::class, 'update'])->name('labor.update');
		Route::delete('/{labor}/delete', [LaboratoryController::class, 'destroy'])->name('labor.delete');
		Route::post('/getDetail', [LaboratoryController::class, 'getDetail'])->name('labor.getDetail');
	});
});