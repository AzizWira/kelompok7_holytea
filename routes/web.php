<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/detail/{slug}', function ($slug) {
    $exists = DB::table('products')
        ->where('slug', $slug)
        ->where('is_active', 1)
        ->exists();

    if (!$exists) {
        abort(404);
    }

    return view('user.detail', compact('slug'));
});

/*
|--------------------------------------------------------------------------
| USER (PUBLIC) ROUTES
|--------------------------------------------------------------------------
| Halaman user TIDAK pakai Bootstrap
| Data diambil via API (fetch dari JS)
*/

// halaman utama
Route::view('/', 'user.index')->name('user.home');

// halaman menu
Route::view('/menu', 'user.menu')->name('user.menu');

// halaman detail produk (pakai slug)
Route::get('/detail/{slug}', function ($slug) {
    $exists = DB::table('products')
        ->where('slug', $slug)
        ->where('is_active', 1)
        ->exists();

    if (!$exists) {
        abort(404);
    }

    return view('user.detail', compact('slug'));
});


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (PLACEHOLDER)
|--------------------------------------------------------------------------
| Nanti akan diproteksi auth + role admin
| Untuk sekarang DISIAPKAN saja
*/

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {

        // halaman login admin
        Route::view('/login', 'admin.login')->name('login');

        // dashboard admin (nanti pakai middleware auth)
        Route::view('/dashboard', 'admin.dashboard')->name('dashboard');
    });


/*
|--------------------------------------------------------------------------
| FALLBACK (404)
|--------------------------------------------------------------------------
*/
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});

