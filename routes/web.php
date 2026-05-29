<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\TestimonialController;


// LANDING
Route::get('/', [LandingController::class, 'index'])->name('landing');

// AUTH
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// KERANJANG
Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
Route::post('/keranjang/tambah/{id}', [KeranjangController::class, 'tambah'])->name('keranjang.tambah');
Route::put('/keranjang/update/{id}', [KeranjangController::class, 'update'])->name('keranjang.update');
Route::delete('/keranjang/hapus/{id}', [KeranjangController::class, 'hapus'])->name('keranjang.hapus');
Route::delete('/keranjang/kosongkan', [KeranjangController::class, 'kosongkan'])->name('keranjang.kosongkan');

// PRODUK DETAIL
Route::get('/produk/{id}', [ProdukController::class, 'detail'])->name('produk.detail');

// TRANSAKSI & PROFILE
Route::middleware('auth')->group(function () {
    Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::get('/transaksi/invoice/{id}', [TransaksiController::class, 'invoice'])->name('transaksi.invoice');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
});

// TESTIMONIAL (customer)
Route::middleware('auth')->group(function () {
    Route::get('/testimonial', [TestimonialController::class, 'create'])->name('testimonial.create');
    Route::post('/testimonial', [TestimonialController::class, 'store'])->name('testimonial.store');
});


// ADMIN
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Manajemen Produk
    Route::post('/produk', [AdminController::class, 'storeProduk'])->name('admin.produk.store');
    Route::get('/produk/{id}/edit', [AdminController::class, 'editProduk'])->name('admin.produk.edit');
    Route::put('/produk/{id}', [AdminController::class, 'updateProduk'])->name('admin.produk.update');
    Route::delete('/produk/{id}', [AdminController::class, 'destroyProduk'])->name('admin.produk.destroy');

    // Manajemen Transaksi
    Route::get('/transaksi', [AdminController::class, 'transaksi'])->name('admin.transaksi');
    Route::delete('/transaksi/{id}', [AdminController::class, 'destroyTransaksi'])->name('admin.transaksi.destroy');

    // Manajemen Pelanggan
    Route::get('/pelanggan', [AdminController::class, 'pelanggan'])->name('admin.pelanggan');
    Route::post('/pelanggan/{id}/reset', [AdminController::class, 'resetPassword'])->name('admin.pelanggan.reset');

    // ADMIN: kelola testimonial
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/testimonials', [TestimonialController::class, 'adminIndex'])->name('admin.testimonials');
    Route::post('/testimonial/{id}/approve', [TestimonialController::class, 'approve'])->name('admin.testimonial.approve');
    Route::post('/testimonial/{id}/reject', [TestimonialController::class, 'reject'])->name('admin.testimonial.reject');
    Route::delete('/testimonial/{id}', [TestimonialController::class, 'destroy'])->name('admin.testimonial.destroy');
});
