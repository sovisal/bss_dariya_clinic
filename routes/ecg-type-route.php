<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EcgTypeController;

Route::middleware(['auth'])->name('setting.')->group(function () {
	Route::prefix('ecg-type')->group(function () {
		Route::get('/', [EcgTypeController::class, 'index'])->name('ecg-type.index');
		Route::get('/create', [EcgTypeController::class, 'create'])->name('ecg-type.create');
		Route::put('/store', [EcgTypeController::class, 'store'])->name('ecg-type.store');
		Route::get('/{ecgType}/edit', [EcgTypeController::class, 'edit'])->name('ecg-type.edit');
		Route::put('/{ecgType}/update', [EcgTypeController::class, 'update'])->name('ecg-type.update');
		Route::delete('/{ecgType}/delete', [EcgTypeController::class, 'destroy'])->name('ecg-type.delete');
	});
});