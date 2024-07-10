<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\IndexController::class, 'index']);
Route::get('/top', [App\Http\Controllers\TopController::class, 'index']);

Route::get('/login', [App\Http\Controllers\LoginController::class, 'index']);
Route::get('/login/register', [App\Http\Controllers\LoginController::class, 'redister']);
Route::get('/login/unregister', [App\Http\Controllers\LoginController::class, 'unregister']);