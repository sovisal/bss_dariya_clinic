<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\XrayController;

Route::middleware(['auth'])->name('para_clinic.')->group(function () {
	Route::prefix('xray')->group(function () {
		Route::get('/', [XrayController::class, 'index'])->name('xray.index');
		Route::get('/create', [XrayController::class, 'create'])->name('xray.create');
		Route::put('/store', [XrayController::class, 'store'])->name('xray.store');
		Route::get('/{xray}/print', [XrayController::class, 'print'])->name('xray.print');
		Route::get('/{xray}/edit', [XrayController::class, 'edit'])->name('xray.edit');
		Route::get('/{xray}/show', [XrayController::class, 'show'])->name('xray.show');
		Route::put('/{xray}/update', [XrayController::class, 'update'])->name('xray.update');
		Route::delete('/{xray}/delete', [XrayController::class, 'destroy'])->name('xray.delete');
		Route::post('/getDetail', [XrayController::class, 'getDetail'])->name('xray.getDetail');
	});
});