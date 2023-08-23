<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ImageController;
use App\Http\Controllers\API\PhotoController;
use App\Http\Controllers\API\TotalController;
use App\Http\Controllers\API\UserrController;
use App\Http\Controllers\Api\GoogleController;
use App\Http\Controllers\API\MetodeController;
use App\Http\Controllers\API\ReplayController;
use App\Http\Controllers\Api\TiketsController;
use App\Http\Controllers\API\RiwayatController;
use App\Http\Controllers\Api\TiketssController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\Api\KeranjangController;
use App\Http\Controllers\Api\Tim_LigasController;
use App\Http\Controllers\API\PembayaranController;
use App\Http\Controllers\Api\Tim_PersikController;
use App\Http\Controllers\Api\Harga_TiketsController;
use App\Http\Controllers\Api\Jenis_TiketsController;
use App\Http\Controllers\API\StrukturPembayaranController;
use App\Http\Controllers\Api\Galery_pertandinganController;
use App\Http\Controllers\Api\Jadwal_pertandinganController;

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

Route::middleware('auth:sanctum')->group(function (){
    Route::get('users', [UserController::class, 'show']);
    Route::get('logout', [UserController::class, 'logout']);
    Route::post('users/update',[UserController::class,'update']);
    Route::get('userss', [UserController::class, 'showw']);
    Route::get('logouut', [UserController::class, 'logouut']);
    Route::post('users/updatee',[UserController::class,'updatee']);
});

Route::apiResource('categories', CategoryController::class);

Route::post('users', [UserController::class, 'store']);
Route::post('users/login', [UserController::class, 'login']);
Route::get('search/{id}', [UserController::class, 'list']);

Route::post('google', [UserController::class, 'tambah']);
Route::post('google/login', [UserController::class, 'index']);
Route::get('google/{id}', [UserController::class, 'list']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('auth/google', [GoogleController::class, 'redirect'])->name('auth.google')->middleware('web');
Route::get('auth/google/callback', [GoogleController::class, 'CallbackGoogle']);

//Route::put('users/{id}/update',[UserController::class,'update']);

Route::get('galery_pertandingan',[Galery_pertandinganController::class,'index']);
Route::post('galery_pertandingan',[Galery_pertandinganController::class,'store']);
Route::get('galery_pertandingan/{id}',[Galery_pertandinganController::class,'show']);
Route::get('galery_pertandingan/search',[Galery_pertandinganController::class,'list']);
Route::put('galery_pertandingan/{id}/edit',[Galery_pertandinganController::class,'update']);
Route::delete('galery_pertandingan/{id}/delete',[Galery_pertandinganController::class,'destory']);

Route::get('photo',[PhotoController::class,'index']);
Route::post('photo',[PhotoController::class,'store']);
Route::get('photo/{id}',[PhotoController::class,'show']);
Route::get('photo/{id}/edit',[PhotoController::class,'edit']);
Route::put('photo/{id}/edit',[PhotoController::class,'update']);
Route::delete('photo/{id}/delete',[PhotoController::class,'destory']);

Route::get('harga_tiket', [Harga_TiketsController::class, 'index']);
Route::post('harga_tiket', [Harga_TiketsController::class, 'store']);
Route::get('harga_tiket/{id}', [Harga_TiketsController::class, 'show']);
Route::get('harga_tiket/{id}/edit', [Harga_TiketsController::class, 'edit']);
Route::put('harga_tiket/{id}/edit', [Harga_TiketsController::class, 'update']);
Route::delete('harga_tiket/{id}/delete', [Harga_TiketsController::class, 'destory']);

Route::get('jenis_tiket', [Jenis_TiketsController::class, 'index']);
Route::post('jenis_tiket', [Jenis_TiketsController::class, 'store']);
Route::get('jenis_tiket/{id}', [Jenis_TiketsController::class, 'show']);
Route::get('jenis_tiket/{id}/edit', [Jenis_TiketsController::class, 'edit']);
Route::put('jenis_tiket/{id}/edit', [Jenis_TiketsController::class, 'update']);
Route::delete('jenis_tiket/{id}/delete', [Jenis_TiketsController::class, 'destory']);

Route::get('tiket', [TiketsController::class, 'index']);
Route::post('tiket', [TiketsController::class, 'store']);
Route::put('tiket/{id}/edit', [TiketsController::class, 'update']);
Route::delete('tiket/{id}/delete', [TiketsController::class, 'destory']); 
Route::get('tiket/search', [TiketsController::class, 'cari']);

Route::get('tampil', [TiketssController::class, 'index']);
Route::post('tambah', [TiketssController::class, 'store']);
Route::get('show/{id}', [TiketssController::class, 'show']);
Route::get('tiket/{id}/edit', [TiketssController::class, 'edit']);
Route::put('tikett/{id}/edit', [TiketssController::class, 'update']);
Route::delete('tikett/{id}/delete', [TiketssController::class, 'destory']); 
Route::get('tikett/{name}', [TiketssController::class, 'search']);

Route::get('jadwal_pertandingan',[Jadwal_pertandinganController::class,'index']);
Route::post('jadwal_pertandingan',[Jadwal_pertandinganController::class,'store']);
Route::get('jadwal_pertandingan/{id}',[Jadwal_pertandinganController::class,'show']);
Route::get('jadwal_pertandingan/{id}/edit',[Jadwal_pertandinganController::class,'edit']);
Route::put('jadwal_pertandingan/{id}/edit',[Jadwal_pertandinganController::class,'update']);
Route::delete('jadwal_pertandingan/{id}/delete',[Jadwal_pertandinganController::class,'destory']);

Route::get('tim_ligas',[Tim_LigasController::class,'index']);
Route::post('tim_ligas',[Tim_LigasController::class,'store']);
Route::get('tim_ligas/{id}',[Tim_LigasController::class,'show']);
Route::get('tim_ligas/{id}/edit',[Tim_LigasController::class,'edit']);
Route::put('tim_ligas/{id}/edit',[Tim_LigasController::class,'update']);
Route::delete('tim_ligas/{id}/delete',[Tim_LigasController::class,'destory']);

Route::get('keranjang', [KeranjangController::class, 'index']);
Route::post('keranjang', [KeranjangController::class, 'store']);
Route::get('keranjang/{id}', [KeranjangController::class, 'show']);
Route::get('keranjang/{id}/edit', [KeranjangController::class, 'edit']);
Route::put('keranjang/{id}/edit', [KeranjangController::class, 'update']);
Route::delete('keranjang/{id}/delete', [KeranjangController::class, 'destory']);

Route::get('tim_persik', [Tim_PersikController::class, 'index']);
Route::post('tim_persik', [Tim_PersikController::class, 'store']);
Route::get('tim_persik/{id}', [Tim_PersikController::class, 'show']);
Route::get('tim_persik/{id}/edit', [Tim_PersikController::class, 'edit']);
Route::put('tim_persik/{id}/edit', [Tim_PersikController::class, 'update']);
Route::delete('tim_persik/{id}/delete', [Tim_PersikController::class, 'destory']);

Route::post('/download', [ImageController::class, 'create']);
Route::get('/get', [ImageController::class, 'get']);
Route::patch('/edit/{id}', [ImageController::class, 'edit']);
Route::post('/update/{id}', [ImageController::class, 'update']);
Route::delete('/delete/{id}', [ImageController::class, 'delete']);

Route::get('bayar', [PembayaranController::class, 'index']);
Route::post('bayar', [PembayaranController::class, 'store']);
Route::get('bayar/{id}', [PembayaranController::class, 'show']);
Route::get('bayar/{id}/edit', [PembayaranController::class, 'edit']);
Route::put('bayar/{id}/edit', [PembayaranController::class, 'update']);
Route::delete('bayar/{id}/delete', [PembayaranController::class, 'destory']);

Route::get('metode',[MetodeController::class,'index']);
Route::post('metode',[MetodeController::class,'store']);
Route::get('metode/{id}',[MetodeController::class,'show']);
Route::get('metode/{id}/edit',[MetodeController::class,'edit']);
Route::put('metode/{id}/edit',[MetodeController::class,'update']);
Route::delete('metode/{id}/delete',[MetodeController::class,'destory']);

Route::get('struk', [StrukturPembayaranController::class, 'index']);
Route::post('struk', [StrukturPembayaranController::class, 'store']);
Route::get('struk/{id}/show', [StrukturPembayaranController::class, 'show']);
Route::delete('struk/{id}/delete', [StrukturPembayaranController::class, 'destory']);

Route::get('replay',[ReplayController::class,'index']);
Route::post('replay',[ReplayController::class,'store']);
Route::get('replay/{id}',[ReplayController::class,'show']);
Route::get('replay/{id}/edit',[ReplayController::class,'edit']);
Route::put('replay/{id}/edit',[ReplayController::class,'update']);
Route::delete('replay/{id}/delete',[ReplayController::class,'destory']);

Route::get('riwayat',[RiwayatController::class,'index']);
Route::post('riwayat',[RiwayatController::class,'store']);
Route::get('riwayat/{id}',[RiwayatController::class,'show']);
Route::put('riwayat/{id}/edit',[RiwayatController::class,'update']);
Route::delete('riwayat/{id}/delete',[RiwayatController::class,'destory']);