<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

//import controller

use App\Http\Controllers\MyController;
use App\Http\Controllers\BackendController;
use App\Http\Middleware\Admin;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Backend\OrderController as BackendOrdersController;
use App\Http\Controllers\Backend\OrderController;



// Route::get('/', function () {
//     return view('layouts.frontend');
// });

// Route::get('about', function () {
//     return 'ini halaman about';
// });

// Route::get('profile', function () {
//     return view('profile');
// });

// // route parameter

// Route::get('produk/{namaProduk}', function($p) {
//     return 'Saya Membeli' .$p;
// });

// Route::get('kategori/{namaKategori}', function($kategori) {
//     return view('kategori', compact('kategori'));

//     // return view('kategori', ['kat' => $kategori]);
// });

// Route::get('search/{keyword?}', function ($key = null) {
//     return view('search', compact('key'));
// });

// // latihan
// Route::get('promo/{barang?}/{kode?}', function ($barang = null, $kode = null) {
//     return view('promo', compact('barang','kode'));
// });

// Route::get('buku', [MyController::class, 'index']);
// Route::get('buku/create', [MyController::class, 'create']);
// Route::post('buku', [MyController::class, 'store']);
// Route::get('buku/{id}', [MyController::class, 'show']);

// // edit dan update
// Route::get('buku/{id}/edit', [MyController::class, 'edit']);
// Route::put('buku/{id}', [MyController::class, 'update']);

// // delete
// Route::delete( 'buku/{id}', [MyController::class, 'destroy']);

Route::get('/',[FrontendController::class,'index']);
Route::get('/product', [FrontendController::class, 'product'])->name('product.index');
Route::get('/product/{product}', [FrontendController::class, 'single_product'])
        ->name('product.show');
Route::get('/product/category/{slug}', [FrontendController::class, 'filterByCategory'])
        ->name('product.filter');

Route::get('/search', [FrontendController::class, 'search'])->name('product.search');

Route::get('/about', [FrontendController::class, 'about']);

// cart
Route::get('/cart',[CartController::class, 'index'])->name('cart.index');
Route::post('/add-to-cart/{product}', [CartController::class, 'addToCart'])->name('cart.add');
Route::put('/cart/update/{id}', [CartController::class, 'updateCart'])->name('cart.update');
Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');
// orders
Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');

// review
Route::post('/product/{product}/review', [App\Http\Controllers\ReviewController::class, 'store'])
->middleware('auth')->name('review.store');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//import middleware

// route admin / backend


Route::group(['prefix' => 'admin', 'as' => 'backend.', 'middleware' => ['auth', Admin::class]], function (){
    Route::get('/', [BackendController::class,'index']);
    // route crud 
    Route::resource('/category', CategoryController::class);
    Route::resource('/product', ProductController::class);
    Route::resource('/orders', OrdersController::class);
    Route::put('/orders/{id}/status', [OrdersController::class, 'updateStatus'])->name('orders.updateStatus');

});