<?php

use App\Http\Controllers\PerubahanModalController;

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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Auth::routes();

// Custum Authenticate 
Route::get('/login', 'AuthController@showlogin')->name('login');
Route::post('/login', 'AuthController@login')->name('login');
Route::get('/register', 'AuthController@showregister')->name('register');
Route::post('/register', 'AuthController@register')->name('register');
Route::post('/logout', 'AuthController@logout')->name('logout');

//Akses All Role
Route::middleware('auth')->group(function () {
    // Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
});

// Akses Role User 
Route::middleware(['checkrole:2'])->group(function () {
    Route::get('/user-dashboard', 'UserController@index')->name('user.dashboard');

    Route::get('/modals', [PerubahanModalController::class, 'index'])->name('perubahanModal');
    Route::get('/modals/create', [PerubahanModalController::class, 'create'])->name('createPerubahanModal');
    Route::post('/modals', [PerubahanModalController::class, 'store'])->name('storePerubahanModal');
    Route::get('/modals/{id}/edit', [PerubahanModalController::class, 'edit'])->name('editPerubahanModal');
    Route::put('/modals/{id}', [PerubahanModalController::class, 'update'])->name('updatePerubahanModal');
    Route::get('/modals/{id}', [PerubahanModalController::class, 'destroy'])->name('deletePerubahanModal');
});

// Akses Role Admin 
Route::middleware(['checkrole:1'])->group(function () {
    Route::get('/admin-dashboard', 'AdminController@index')->name('admin.dashboard');
});
