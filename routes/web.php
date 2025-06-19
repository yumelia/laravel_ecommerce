<?php

use Illuminate\Support\Facades\Route;

//import controller

use App\Http\Controllers\MyController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('about', function () {
    return 'ini halaman about';
});

Route::get('profile', function () {
    return view('profile');
});

// route parameter

Route::get('produk/{namaProduk}', function($p) {
    return 'Saya Membeli' .$p;
});

Route::get('kategori/{namaKategori}', function($kategori) {
    return view('kategori', compact('kategori'));

    // return view('kategori', ['kat' => $kategori]);
});

Route::get('search/{keyword?}', function ($key = null) {
    return view('search', compact('key'));
});

// latihan
Route::get('promo/{barang?}/{kode?}', function ($barang = null, $kode = null) {
    return view('promo', compact('barang','kode'));
});

Route::get('buku', [MyController::class, 'index']);
Route::get('buku/create', [MyController::class, 'create']);
Route::post('buku', [MyController::class, 'store']);
Route::get('buku/{id}', [MyController::class, 'show']);

// edit dan update
Route::get('buku/{id}/edit', [MyController::class, 'edit']);
Route::put('buku/{id}', [MyController::class, 'update']);

// delete
Route::delete( 'buku/{id}', [MyController::class, 'destroy']);
