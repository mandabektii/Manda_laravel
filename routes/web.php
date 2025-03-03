<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManagementUserController;
use App\Http\Controllers\Frontend\HomeController;

Route::get('/', function () {
    return view('welcome');
});

//Acara 3
// Route dasar
Route::get('/hello', function () {
    return "Halo, Selamat datang di Laravel!";
});
Route::get('/user/{id}', function ($id) {
    return "User ID: " . $id;
});
Route::get('/user/{id}/name/{name}', function ($id, $name) {
    return "User ID: $id, Nama: $name";
});
Route::get('/profile/{name?}', function ($name = "Guest") {
    return "Halo, " . $name;
});
Route::get('/dashboard', function () {
    return "Ini adalah Dashboard";
})->name('dashboard');
Route::get('/go-to-dashboard', function () {
    return redirect()->route('dashboard');
});
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return "Admin Dashboard";
    });
    Route::get('/users', function () {
        return "Manajemen Pengguna";
    });
});

//Acara 4
// Named Route
Route::get('/profile', function () {
    return "Ini adalah halaman profil";
})->name('profile');

// Menggunakan Named Route di Redirect
Route::get('/redirect-profile', function () {
    return redirect()->route('profile');
});
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return "Admin Dashboard";
    })->name('admin.dashboard');

    Route::get('/users', function () {
        return "Manajemen Pengguna";
    })->name('admin.users');
});

//Acara 5
Route::get('/user', [ManagementUserController::class, 'index']);

//Acara 6
Route::get('/home', function () {
    return view('home');
});
Route::get('/user', [ManagementUserController::class, 'index']);

//Acara 7
Route::group(['namespace' => 'App\Http\Controllers\frontend'], function() {
    Route::resource('home', 'HomeController');
});

//Acara 8
Route::group(['namespace' => 'App\Http\Controllers\backend'], function() {
    Route::resource('dashboard', 'DashboardController');
});