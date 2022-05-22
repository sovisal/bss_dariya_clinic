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
	Route::post('/getSelect2', [PatientController::class, 'getSelect2'])->name('getSelect2');

	Route::prefix('consultation')->group(function () {
		Route::get('/', [ConsultationController::class, 'index'])->name('consultation.index')->middleware('can:ViewAnyConsultation');
		Route::get('/create', [ConsultationController::class, 'create'])->name('consultation.create')->middleware('can:CreateConsultation');
		Route::post('/store', [ConsultationController::class, 'store'])->name('consultation.store')->middleware('can:CreateConsultation');
		Route::get('/{consultation}/edit', [ConsultationController::class, 'edit'])->name('consultation.edit')->middleware('can:CreateConsultation');
		Route::put('/{consultation}/update', [ConsultationController::class, 'update'])->name('consultation.update')->middleware('can:CreateConsultation');
<<<<<<< HEAD
		Route::post('/getTemplate', [ConsultationController::class, 'getTemplate'])->name('consultation.getTemplate');
=======
		Route::get('/get_indication/{category_id}', function ($category_id) {
			return json_encode(getParentDataSelection('indication_disease', ['status' => 1, 'parent_id' => $category_id]));
		})->name('consultation.get_indication');
>>>>>>> 882a5bfd6d16adcf7adc1ec7065bd4ff9dc14c3c
	});
});