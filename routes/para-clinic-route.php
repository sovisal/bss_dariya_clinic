<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaborController;
use App\Http\Controllers\XRayController;
use App\Http\Controllers\EchographyController;
use App\Http\Controllers\EGCController;


Route::middleware(['auth'])->prefix('para-clinic')->name('para_clinic.')->group(function () {
	// Route::get('/', [ParaClinicController::class, 'index'])->name('index')->middleware('can:ViewAnyParaclinic');

	Route::prefix('x-ray')->name('x_ray.')->group(function () {
		Route::get('/', [XRayController::class, 'index'])->name('index')->middleware('can:ViewAnyXRay');
		Route::get('/create', [XRayController::class, 'create'])->name('create')->middleware('can:CreateXRay');
		Route::post('/store', [XRayController::class, 'store'])->name('store')->middleware('can:CreateXRay');
		Route::get('/{x_ray}/edit', [XRayController::class, 'edit'])->name('edit')->middleware('can:UpdateXRay');
		Route::put('/{x_ray}/update', [XRayController::class, 'update'])->name('update')->middleware('can:UpdateXRay');
		Route::delete('/{x_ray}/delete', [XRayController::class, 'destroy'])->name('delete')->middleware('can:DeleteXRay');
		Route::get('/{x_ray}/show', [XRayController::class, 'show'])->name('show')->middleware('can:ViewAnyXRay');
	});

	Route::prefix('echography')->name('echography.')->group(function () {
		Route::get('/', [EchographyController::class, 'index'])->name('index')->middleware('can:ViewAnyEchography');
		Route::get('/create', [EchographyController::class, 'create'])->name('create')->middleware('can:CreateEchography');
		Route::post('/store', [EchographyController::class, 'store'])->name('store')->middleware('can:CreateEchography');
		Route::get('/{echography}/edit', [EchographyController::class, 'edit'])->name('edit')->middleware('can:UpdateEchography');
		Route::put('/{echography}/update', [EchographyController::class, 'update'])->name('update')->middleware('can:UpdateEchography');
		Route::delete('/{echography}/delete', [EchographyController::class, 'destroy'])->name('delete')->middleware('can:DeleteEchography');
		Route::get('/{echography}/show', [EchographyController::class, 'show'])->name('show')->middleware('can:ViewAnyEchography');
	});

	// Route::prefix('egc')->name('egc.')->group(function () {
	// 	Route::get('/', [EGCController::class, 'index'])->name('index')->middleware('can:ViewAnyEGC');
	// 	Route::get('/create', [EGCController::class, 'create'])->name('create')->middleware('can:CreateEGC');
	// 	Route::post('/store', [EGCController::class, 'store'])->name('store')->middleware('can:CreateEGC');
	// 	Route::get('/{egc}/edit', [EGCController::class, 'edit'])->name('edit')->middleware('can:UpdateEGC');
	// 	Route::put('/{egc}/update', [EGCController::class, 'update'])->name('update')->middleware('can:UpdateEGC');
	// 	Route::delete('/{egc}/delete', [EGCController::class, 'destroy'])->name('delete')->middleware('can:DeleteEGC');
	// 	Route::get('/{egc}/show', [EGCController::class, 'show'])->name('show')->middleware('can:ViewAnyEGC');
	// });
});