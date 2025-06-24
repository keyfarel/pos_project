<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\Api\LevelController;
use App\Http\Controllers\Api\BarangController;
use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PenjualanController;

Route::middleware('jwt.verify')->group(function () {
    Route::apiResource('level', LevelController::class);
    Route::apiResource('barang', BarangController::class);
    Route::apiResource('kategori', KategoriController::class);
    Route::apiResource('user', UserController::class);
    Route::apiResource('penjualan', PenjualanController::class);

    Route::get('/auth_user', function (Request $request) {
        return response()->json([
            'status' => true,
            'user' => auth()->user()
        ]);
    });
});

Route::post('/register', App\Http\Controllers\Api\RegisterController::class)->name('api.register');
Route::post('/login', App\Http\Controllers\Api\LoginController::class)->name('api.login');
Route::post('/logout', App\Http\Controllers\Api\LogoutController::class)->name('logout');
