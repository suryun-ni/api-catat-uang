<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\AuthController;
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
// Route::get('/profile', [UserController::class,'index']);

Route::post('keuangan',[KeuanganController::class,'store']);
Route::put('keuangan/{id}',[KeuanganController::class,'update']);
Route::get('/index', [KeuanganController::class, 'index']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile',[AuthController::class, 'getProfile']);
    Route::put('/profile',[UserController::class,'update']);
    // API route for logout user
    Route::post('/logout', [AuthController::class, 'logout']);
});