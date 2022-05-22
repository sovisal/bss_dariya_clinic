<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EcgController;

Route::middleware(['auth'])->name('para_clinic.')->group(function () {
	Route::prefix('ecg')->group(function () {
		Route::get('/', [EcgController::class, 'index'])->name('ecg.index');
		Route::get('/create', [EcgController::class, 'create'])->name('ecg.create');
		Route::put('/store', [EcgController::class, 'store'])->name('ecg.store');
		Route::get('/{ecg}/print', [EcgController::class, 'print'])->name('ecg.print');
		Route::get('/{ecg}/edit', [EcgController::class, 'edit'])->name('ecg.edit');
		Route::get('/{ecg}/show', [EcgController::class, 'show'])->name('ecg.show');
		Route::put('/{ecg}/update', [EcgController::class, 'update'])->name('ecg.update');
		Route::delete('/{ecg}/delete', [EcgController::class, 'destroy'])->name('ecg.delete');
		Route::post('/getDetail', [EcgController::class, 'getDetail'])->name('ecg.getDetail');
	});
});