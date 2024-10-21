<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\StudentController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/students', [StudentController::class, 'index'])->middleware('auth:sanctum');
Route::post('/students/{id}', [StudentController::class, 'destroy'])->middleware('auth:sanctum');
Route::post('/students', [StudentController::class, 'store'])->middleware('auth:sanctum');
Route::put('/students/{id}', [StudentController::class, 'update'])->middleware('auth:sanctum');

