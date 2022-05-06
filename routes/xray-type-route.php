<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\XrayTypeController;

Route::middleware(['auth'])->name('setting.')->group(function () {
	Route::prefix('xray-type')->group(function () {
		Route::get('/', [XrayTypeController::class, 'index'])->name('xray-type.index');
		Route::get('/create', [XrayTypeController::class, 'create'])->name('xray-type.create');
		Route::put('/store', [XrayTypeController::class, 'store'])->name('xray-type.store');
		Route::get('/{xrayType}/edit', [XrayTypeController::class, 'edit'])->name('xray-type.edit');
		Route::put('/{xrayType}/update', [XrayTypeController::class, 'update'])->name('xray-type.update');
		Route::delete('/{xrayType}/delete', [XrayTypeController::class, 'destroy'])->name('xray-type.delete');
	});
});