<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrescriptionController;

Route::prefix('prescription')->name('prescription.')->group(function () {
	Route::get('/', [PrescriptionController::class, 'index'])->name('index');
	Route::get('/create', [PrescriptionController::class, 'create'])->name('create')->middleware('can:CreatePrescription');
	Route::put('/store', [PrescriptionController::class, 'store'])->name('store')->middleware('can:CreatePrescription');
	Route::get('/{echography}/print', [PrescriptionController::class, 'print'])->name('print');
	Route::get('/{prescription}/edit', [PrescriptionController::class, 'edit'])->name('edit')->middleware('can:UpdatePrescription');
	Route::put('/{prescription}/update', [PrescriptionController::class, 'update'])->name('update')->middleware('can:UpdatePrescription');
	Route::delete('/{prescription}/delete', [PrescriptionController::class, 'destroy'])->name('delete')->middleware('can:DeletePrescription');
	Route::get('/{prescription}/show', [PrescriptionController::class, 'show'])->name('show')->middleware('can:ViewAnyPrescription');
	Route::post('/getSelect2', [PrescriptionController::class, 'getSelect2'])->name('getSelect2');
	Route::post('/getDetail', [PrescriptionController::class, 'getDetail'])->name('getDetail');
});