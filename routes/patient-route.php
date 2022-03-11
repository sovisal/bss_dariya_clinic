<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ConsultationController;


Route::middleware(['auth'])->prefix('patient')->name('patient.')->group(function () {

	Route::get('/', [PatientController::class, 'index'])->name('index')->middleware('can:ViewAnyPatient');
	Route::get('/create', [PatientController::class, 'create'])->name('create')->middleware('can:CreatePatient');
	Route::post('/store', [PatientController::class, 'store'])->name('store')->middleware('can:CreatePatient');
	Route::get('/{patient}/edit', [PatientController::class, 'edit'])->name('edit')->middleware('can:UpdatePatient');
	Route::put('/{patient}/update', [PatientController::class, 'update'])->name('update')->middleware('can:UpdatePatient');
	Route::delete('/{patient}/delete', [PatientController::class, 'destroy'])->name('delete')->middleware('can:DeletePatient');
	Route::get('/{patient}/show', [PatientController::class, 'show'])->name('show')->middleware('can:ViewAnyPatient');

	Route::prefix('consultation')->group(function () {
		Route::get('/', [ConsultationController::class, 'index'])->name('consultation_index')->middleware('can:ViewAnyConsultation');
		Route::get('/{patient}/create', [ConsultationController::class, 'create'])->name('consultation_create')->middleware('can:CreateConsultation');
	});
});