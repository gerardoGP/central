<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorizedSystemController;
Route::get('/', function () {
    return view('dashboard');
});

Route::get('/authorized-system/create', [AuthorizedSystemController::class, 'create'])->name('authorizedsystem.create');
Route::get('/authorized-system/store', [AuthorizedSystemController::class, 'store'])->name('authorizedsystem.store');