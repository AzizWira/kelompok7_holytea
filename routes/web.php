<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/detail/{slug}', function (string $slug) {
    return view('user.detail', compact('slug'));
})
    ->where('slug', '[a-z0-9-]+')
    ->name('user.detail');


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
    // Pastikan resources/views/errors/404.blade.php ada
    return response()->view('errors.404', [], 404);
});
