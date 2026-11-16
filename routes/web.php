<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorizedSystemController;
use App\Http\Controllers\Web\ApiConsumerController;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/authorized-system', [AuthorizedSystemController::class, 'index'])->name('authorizedsystem.index');
Route::get('/authorized-system/create', [AuthorizedSystemController::class, 'create'])->name('authorizedsystem.create');
Route::post('/authorized-system/store', [AuthorizedSystemController::class, 'store'])->name('authorizedsystem.store');

Route::resource('api-consumers', ApiConsumerController::class)->only(['index', 'store']);