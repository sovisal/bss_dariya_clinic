<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FourLevelAddressController;

Route::middleware(['auth'])->name('setting.')->group(function () {
	
	Route::prefix('setting')->group(function () {
		Route::get('/', [HomeController::class, 'setting'])->name('edit');
		Route::put('/update', [HomeController::class, 'setting_update'])->name('update');
	});

	Route::middleware(['auth'])->prefix('address')->group(function () {
		Route::get('/', [FourLevelAddressController::class, 'index'])->name('address.index');
		Route::post('/getFullAddress', [FourLevelAddressController::class, 'BSSFullAddress'])->name('getFullAddress');
		Route::post('/getProvinceChileSelection', [FourLevelAddressController::class, 'District'])->name('getProvinceChileSelection');
		Route::post('/getDistrictChileSelection', [FourLevelAddressController::class, 'Commune'])->name('getDistrictChileSelection');
		Route::post('/getCommuneChileSelection', [FourLevelAddressController::class, 'Village'])->name('getCommuneChileSelection');
	});
});