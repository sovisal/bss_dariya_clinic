<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MedicineController;
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

	Route::prefix('doctor')->name('doctor.')->group(function () {
		Route::get('/', [DoctorController::class, 'index'])->name('index');
		Route::get('/create', [DoctorController::class, 'create'])->name('create')->middleware('can:CreateDoctor');
		Route::post('/store', [DoctorController::class, 'store'])->name('store')->middleware('can:CreateDoctor');
		Route::get('/{doctor}/edit', [DoctorController::class, 'edit'])->name('edit')->middleware('can:UpdateDoctor');
		Route::put('/{doctor}/update', [DoctorController::class, 'update'])->name('update')->middleware('can:UpdateDoctor');
		Route::delete('/{doctor}/delete', [DoctorController::class, 'destroy'])->name('delete')->middleware('can:DeleteDoctor');
		Route::get('/{doctor}/show', [DoctorController::class, 'show'])->name('show')->middleware('can:ViewAnyDoctor');
		Route::post('/getSelect2', [DoctorController::class, 'getSelect2'])->name('getSelect2');
	});

	Route::prefix('medicine')->name('medicine.')->group(function () {
		Route::get('/', [MedicineController::class, 'index'])->name('index');
		Route::get('/create', [MedicineController::class, 'create'])->name('create')->middleware('can:CreateMedicine');
		Route::post('/store', [MedicineController::class, 'store'])->name('store')->middleware('can:CreateMedicine');
		Route::get('/{medicine}/edit', [MedicineController::class, 'edit'])->name('edit')->middleware('can:UpdateMedicine');
		Route::put('/{medicine}/update', [MedicineController::class, 'update'])->name('update')->middleware('can:UpdateMedicine');
		Route::delete('/{medicine}/delete', [MedicineController::class, 'destroy'])->name('delete')->middleware('can:DeleteMedicine');
		Route::get('/{medicine}/show', [MedicineController::class, 'show'])->name('show')->middleware('can:ViewAnyMedicine');
		Route::post('/getSelect2', [MedicineController::class, 'getSelect2'])->name('getSelect2');
	});
});