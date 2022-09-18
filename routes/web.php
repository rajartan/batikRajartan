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

// Pesana
Route::get('pesan/{barang}', [PesanController::class, 'index'])->middleware('auth')->name('pesan.show');
Route::post('pesan/{barang}', [PesanController::class, 'store'])->middleware('auth')->name('pesan.store');

require __DIR__.'/auth.php';
