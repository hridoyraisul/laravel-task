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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register', [\App\Http\Controllers\AuthController::class,'register']);
Route::post('/login', [\App\Http\Controllers\AuthController::class,'login']);
Route::get('/get-user/{user_id}',[\App\Http\Controllers\AuthController::class,'getUser']);
Route::get('/user-list',[\App\Http\Controllers\AuthController::class,'userList']);
Route::post('/profile-update/{user_id}',[\App\Http\Controllers\AuthController::class,'profileUpdate']);
Route::post('/create-role',[\App\Http\Controllers\RoleController::class,'createRole']);
Route::post('/assign-role',[\App\Http\Controllers\RoleController::class,'assignRole']);
Route::post('/delete-user-role',[\App\Http\Controllers\RoleController::class,'deleteRole']);

