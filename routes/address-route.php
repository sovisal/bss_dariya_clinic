<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FourLevelAddressController;

Route::middleware(['auth'])->group(function () {
    Route::get('/address', [FourLevelAddressController::class, 'index'])->name('address.index');
});