<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/listUsers', [App\Http\Controllers\MobileController::class, 'listUsers'])->name('listUsers');
Route::post('/Login', [App\Http\Controllers\MobileController::class, 'Login'])->name('Login');
Route::post('/Punchin', [App\Http\Controllers\MobileController::class, 'Punchin'])->name('Punchin');
Route::post('/Punchout', [App\Http\Controllers\MobileController::class, 'Punchout'])->name('Punchout');