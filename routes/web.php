<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PesanController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', HomeController::class)->middleware('auth')->name('dashboard');

// Pesanan
Route::get('pesan/{barang}', [PesanController::class, 'index'])->middleware('auth')->name('pesan.show');
Route::post('pesan/{barang}', [PesanController::class, 'store'])->middleware('auth')->name('pesan.store');

// Checkout
Route::get('checkout', [PesanController::class, 'checkout'])->name('checkout');
Route::delete('checkout/{pesanan_detail}', [PesanController::class, 'destroy'])->name('destroy');
Route::post('konfirmasi', [PesanController::class, 'konfirmasi'])->name('konfirmasi');

require __DIR__.'/auth.php';
