<?php

use App\Http\Controllers\TblPerubahanModalController;

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
Route::group(['middleware' => 'cekRole:2'], function () {
    Route::get('/user-dashboard', 'UserController@index')->name('user.dashboard');

    Route::get('/modals', [TblPerubahanModalController::class, 'index'])->name('perubahanModal');
Route::get('/modals/create', [TblPerubahanModalController::class, 'create'])->name('createPerubahanModal');
Route::post('/modals', [TblPerubahanModalController::class, 'store'])->name('storePerubahanModal');
Route::get('/modals/{id}/edit', [TblPerubahanModalController::class, 'edit'])->name('editPerubahanModal');
Route::put('/modals/{id}', [TblPerubahanModalController::class, 'update'])->name('updatePerubahanModal');

Route::get('/modals/{id}', [TblPerubahanModalController::class, 'destroy'])->name('deletePerubahanModal');
});

// Akses Role Admin 
Route::group(['middleware' => 'cekRole:1'], function () {
    Route::get('/admin-dashboard', 'AdminController@index')->name('admin.dashboard');
});
