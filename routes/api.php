<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
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
//post
Route::post('receivePayment', [PaymentController::class, 'CreceivePayment']);

//user
Route::post('Riregister', [UserController::class, 'Ciregister']);
Route::post('Rlogin', [UserController::class, 'Clogin']);
Route::post('Rlogout', [UserController::class, 'Clogout']);