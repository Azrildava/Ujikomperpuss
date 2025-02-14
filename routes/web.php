<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenulisController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PenerbitController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\PeminjamanController;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin,staf']], function () {
    // Route::get('home', [DashboardController::class, 'index'])->name('home');
    Route::resource('kategori', KategoriController::class);
    Route::resource('penerbit', PenerbitController::class);
    Route::resource('penulis', PenulisController::class);
    Route::resource('buku', BukuController::class);
    Route::post('/peminjaman /{id}', [PeminjamanController::class, 'pinjamBuku'])->name('pinjam');


    // Route::resource('user', UserController::class);

    // Route::get('peminjaman', [PeminjamanBukuController::class, 'indexadmin'])->name('peminjamanadmin.index');
    // Route::get('peminjaman/{id}/detail', [PeminjamanBukuController::class, 'show'])->name('peminjamanadmin.detail');
});

Route::group(['prefix' => 'user', 'middleware' => ['auth']], function () {
    Route::get('daftarBuku', [FrontController::class, 'daftarBuku']);
});

Route::post('/logout', function () {
    Auth::logout();
    return view ('/login');
})->name('logout');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
