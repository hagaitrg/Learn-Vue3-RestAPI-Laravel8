<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;

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

Route::middleware('auth:api')->get('/user', function (Requesst $request) {
    return $request->user();
});

Route::get('/transaction', [TransactionController::class, 'index']); 
Route::get('/transaction/detail-transaction/{id}', [TransactionController::class, 'show']);
Route::post('/transaction/create-transaction',[TransactionController::class, 'store']);
Route::put('/transaction/update-transaction/{id}',[TransactionController::class, 'update']);
Route::delete('/transaction/delete-transaction/{id}',[TransactionController::class, 'destroy']);