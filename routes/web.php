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

//Akses All Role
Route::middleware('auth')->group(function () {

    //========================= Ini Route My Profile =========================\\
    Route::get('/profile', 'ProfileController@index')->name('profile.index');
    Route::put('/profile/aboutme/{user}', 'ProfileController@updateAboutMe')->name('profile.update.aboutme');
    Route::put('/profile/password/{user}', 'ProfileController@updatePassword')->name('profile.update.password');

      //========================= Ini Route Perubahan Modal =========================\\
      Route::get('/modals', [PerubahanModalController::class, 'index'])->name('perubahanModal');

      //========================= Ini Route Neraca =========================\\
      Route::get('/neraca', [NeracaController::class, 'index'])->name('neraca.index');
});

// Akses Role User 
Route::middleware(['checkrole:2'])->group(function () {
    //Dashboard User
    Route::get('/user-dashboard', 'UserController@index')->name('user.dashboard');

    //========================= Ini Route Perubahan Modal =========================\\
    
    Route::get('/modals/create', [PerubahanModalController::class, 'create'])->name('createPerubahanModal');
    Route::post('/modals', [PerubahanModalController::class, 'store'])->name('storePerubahanModal');
    Route::get('/modals/{id}/edit', [PerubahanModalController::class, 'edit'])->name('editPerubahanModal');
    Route::put('/modals/{id}', [PerubahanModalController::class, 'update'])->name('updatePerubahanModal');
    Route::get('/modals/{id}', [PerubahanModalController::class, 'destroy'])->name('deletePerubahanModal');


   
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

  
});
