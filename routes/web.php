<?php

use App\Http\Controllers\PerubahanModalController;
use App\Http\Controllers\NeracaController;


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

// Halaman Awal (Landing Page)
Route::get('/', function () {
    return view('frondend.index');
})->name('frondend');

// Auth::routes();

// Custum Authenticate 
Route::get('/login', 'AuthController@showlogin')->name('login');
Route::post('/login', 'AuthController@login')->name('login');
Route::get('/register', 'AuthController@showregister')->name('register');
Route::post('/register', 'AuthController@register')->name('register');
Route::post('/logout', 'AuthController@logout')->name('logout');

//Forget Password
Route::get('/forgot-password', 'ForgetPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/forgot-password', 'ForgetPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/reset-password/{token}', 'ForgetPasswordController@showResetPasswordForm')->name('password.show');
Route::post('/reset-password', 'ForgetPasswordController@resetPasswordForm')->name('password.update');

//Akses All Role
Route::middleware('auth')->group(function () {

    //========================= Ini Route My Profile =========================\\
    Route::get('/profile', 'ProfileController@index')->name('profile.index');
    Route::put('/profile/aboutme/{user}', 'ProfileController@updateAboutMe')->name('profile.update.aboutme');
    Route::put('/profile/password/{user}', 'ProfileController@updatePassword')->name('profile.update.password');

    //========================= Ini Route Perubahan Modal =========================\\
    Route::get('/modals', 'PerubahanModalController@index')->name('perubahanmodal.index');
    Route::get('/modals/create', 'PerubahanModalController@create')->name('perubahanmodal.create');
    Route::post('/modals', 'PerubahanModalController@store')->name('perubahanmodal.store');
    Route::get('/modals/{id}/edit', 'PerubahanModalController@edit')->name('perubahanmodal.edit');
    Route::put('/modals/{id}', 'PerubahanModalController@update')->name('perubahanmodal.update');
    Route::get('/modals/{id}/delete', 'PerubahanModalController@destroy')->name('perubahanmodal.delete');

    //========================= Ini Route Neraca =========================\\
    Route::get('/neraca', 'NeracaController@index')->name('neraca.index');

    //========================= Ini Route Aruskas =========================\\
    Route::get('/aruskas', 'CatatanKeuanganController@index')->name('aruskas.index');
    Route::get('/aruskas/create', 'CatatanKeuanganController@create')->name('aruskas.create');
    Route::post('/aruskas', 'CatatanKeuanganController@store')->name('aruskas.store');
    Route::get('/aruskas/{catatanKeuangan}/edit', 'CatatanKeuanganController@edit')->name('aruskas.edit');
    Route::put('/aruskas/{catatanKeuangan}', 'CatatanKeuanganController@update')->name('aruskas.update');
    Route::get('/aruskas/{catatanKeuangan}/delete', 'CatatanKeuanganController@destroy')->name('aruskas.delete');
    Route::post('/aruskas/filtersubmit', 'CatatanKeuanganController@filter')->name('aruskas.filter');

    //========================= Ini Pendapatan dan Pengeluaran =========================\\
    Route::get('/labarugi', 'LabarugiController@index')->name('labarugi.index');
});

// Akses Role User 
Route::middleware(['checkrole:2'])->group(function () {
    //Dashboard User
    Route::get('/user-dashboard', 'UserController@index')->name('user.dashboard');
});


// Akses Role Admin 
Route::middleware(['checkrole:1'])->group(function () {
    //Dashboard Admin
    Route::get('/admin-dashboard', 'AdminController@index')->name('admin.dashboard');

    //========================= Ini Route Manajemen Users =========================\\
    Route::get('/users', 'UsersController@index')->name('admin.users.index');
    Route::get('/users/create', 'UsersController@create')->name('admin.users.create');
    Route::post('/users', 'UsersController@store')->name('admin.users.store');
    Route::get('/users/{user}', 'UsersController@show')->name('admin.users.show');
    Route::get('/users/{user}/edit', 'UsersController@edit')->name('admin.users.edit');
    Route::put('/users/{user}', 'UsersController@update')->name('admin.users.update');
    Route::get('/users/delete/{user}', 'UsersController@destroy')->name('admin.users.destroy');
    Route::get('/users/reset-password/{id}', 'UsersController@resetPassword')->name('admin.users.resetPassword');

    //========================= Ini Route Kategori =========================\\
    Route::get('/kategori', 'KategoriController@index')->name('admin.kategori.index');
    Route::get('/kategori/create', 'KategoriController@create')->name('admin.kategori.create');
    Route::post('/kategori', 'KategoriController@store')->name('admin.kategori.store');
    Route::get('/kategori/{kategori}', 'KategoriController@show')->name('admin.kategori.show');
    Route::get('/kategori/{kategori}/edit', 'KategoriController@edit')->name('admin.kategori.edit');
    Route::put('/kategori/{kategori}', 'KategoriController@update')->name('admin.kategori.update');
    Route::get('/kategori/delete/{kategori}', 'KategoriController@destroy')->name('admin.kategori.destroy');
});
