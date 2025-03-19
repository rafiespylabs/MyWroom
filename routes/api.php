<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/listUsers', [App\Http\Controllers\MobileController::class, 'listUsers'])->name('listUsers');
Route::post('/login', [App\Http\Controllers\MobileController::class, 'login'])->name('login');
Route::post('/punch_in', [App\Http\Controllers\MobileController::class, 'punch_in'])->name('punch_in');
Route::post('/punchout', [App\Http\Controllers\MobileController::class, 'punchout'])->name('punchout');
Route::post('/attendance_status',  [App\Http\Controllers\MobileController::class, 'attendance_status'])->name('attendance_status');