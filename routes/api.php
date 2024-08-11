<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\StoreController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\TransectionController;
use App\Http\Controllers\API\ReportController;
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

Route::get('user/checkaut',[UserController::class,'checkaut']);
Route::post('login',[UserController::class,'login']);
Route::post('register',[UserController::class,'register']);
Route::post('logout',[UserController::class,'logout'])->middleware('auth:sanctum');
Route::post('transection/add',[]);

Route::group(['prefix' => 'store', 'middleware' => 'auth:sanctum'], function(){
    Route::post('post',[StoreController::class, 'add']);
    Route::get('get',[StoreController::class, 'index']);
    Route::get('edit/{id}',[StoreController::class, 'edit']);
    Route::post('update/{id}',[StoreController::class,'update']);
    Route::delete('delete/{id}',[StoreController::class,'delete']);
});

Route::group(['prefix' => 'transection', 'middleware' => 'auth:sanctum'], function(){
    Route::post('/',[TransectionController::class, 'index']);
    Route::post('add',[TransectionController::class, 'add']);
});

Route::group(['prefix' => 'report', 'middleware' => 'auth:sanctum'], function(){
    Route::post('/',[ReportController::class, 'index']);
    Route::post('add',[ReportController::class, 'add']);
});
