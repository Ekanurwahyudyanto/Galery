<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PhotoController;
use App\Http\Controllers\Api\Galery_pertandinganController;


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

Route::get('galery_pertandingan',[Galery_pertandinganController::class,'index']);
Route::post('galery_pertandingan',[Galery_pertandinganController::class,'store']);
Route::get('galery_pertandingan/{id}',[Galery_pertandinganController::class,'show']);
Route::get('galery_pertandingan/{id}/edit',[Galery_pertandinganController::class,'edit']);
Route::put('galery_pertandingan/{id}/edit',[Galery_pertandinganController::class,'update']);
Route::delete('galery_pertandingan/{id}/delete',[Galery_pertandinganController::class,'destory']);

Route::get('photo',[PhotoController::class,'index']);
Route::post('photo',[PhotoController::class,'store']);
Route::get('photo/{id}',[PhotoController::class,'show']);
Route::get('photo/{id}/edit',[PhotoController::class,'edit']);
Route::put('photo/{id}/edit',[PhotoController::class,'update']);
Route::delete('photo/{id}/delete',[PhotoController::class,'destory']);
