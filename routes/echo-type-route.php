<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EchoTypeController;

Route::middleware(['auth'])->name('setting.')->group(function () {
	Route::prefix('echo-type')->group(function () {
		Route::get('/', [EchoTypeController::class, 'index'])->name('echo-type.index');
		Route::get('/create', [EchoTypeController::class, 'create'])->name('echo-type.create');
		Route::put('/store', [EchoTypeController::class, 'store'])->name('echo-type.store');
		Route::get('/{echoType}/edit', [EchoTypeController::class, 'edit'])->name('echo-type.edit');
		Route::put('/{echoType}/update', [EchoTypeController::class, 'update'])->name('echo-type.update');
		Route::delete('/{echoType}/delete', [EchoTypeController::class, 'destroy'])->name('echo-type.delete');
	});
});