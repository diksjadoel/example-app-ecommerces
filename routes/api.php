<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::prefix('auth')->group(function(){
    Route::post('/login', [App\Http\Controllers\Auth\AuthController::class, 'userLoggedIn']);
    Route::get('/refresh',[App\Http\Controllers\Auth\AuthController::class,'refreshToken'])->middleware(['auth:api_admin']);
    Route::get('/google', [App\Http\Controllers\Auth\AuthController::class,'signInByGoogle']);
    Route::get('/google/callback',[App\Http\Controllers\Auth\AuthController::class,'googleCallback']);
    Route::post('/change/code',[App\Http\Controllers\Auth\AuthController::class,'googleAuthentication']);
});

Route::prefix('admin')->group(function(){
    Route::get('/submenu',[App\Http\Controllers\Auth\AuthController::class, 'userData'])->middleware(['jwttoken','jwt.auth']);
    Route::get('/usermenu',[App\Http\Controllers\Auth\AuthController::class,'menu']);
});
