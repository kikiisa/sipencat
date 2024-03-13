<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[AuthController::class,'index'])->name('auth');
Route::post('/',[AuthController::class,'store'])->name('auth.store');
Route::get('/logout',[AuthController::class,'logout'])->name('auth.logout');

Route::prefix('account')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard');
        Route::resource('transaksi',TransaksiController::class);
        Route::resource('profile',ProfileController::class);
        Route::resource('master-user',MasterUserController::class);
        Route::get('transaksi/cetak/{id}',[TransaksiController::class,'cetak'])->name('transaksi.cetak');
        
    });
});