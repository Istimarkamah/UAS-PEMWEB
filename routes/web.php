<?php

use App\Http\Controllers\Buku;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware('auth')->group(function () {
    Route::get('/', [Buku::class, 'index']);
    Route::post('/create', [Buku::class, 'create']);
    Route::get('/update/{id}', [Buku::class, 'update']);
    Route::post('/update/', [Buku::class, 'updateStore']);
    Route::get('/delete/{id}', [Buku::class, 'delete']);
    Route::get('logout', [Buku::class, 'logout']);
    Route::get('laporan', [Buku::class, 'laporan']);
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [Buku::class, 'register']);
    Route::post('/register', [Buku::class, 'registerStore']);
    Route::get('/login', [Buku::class, 'login'])->name('login');
    Route::post('/login', [Buku::class, 'loginStore'])->name('login');
});
