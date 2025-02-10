<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//import Contrllernya
use App\Http\Controllers\Api\AuthController;


Route::get('/profile', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//auth
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
