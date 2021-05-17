<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Homepage (non-login)
Route::get('/', function () {
    return view('pages.umum.home');
})->name('homepage');

// Route auth
Auth::routes();

//Rote verifikasi email
Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser')->name('verifiy_user');

// Route untuk admin
Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:admin-users', 'can:verified-users')->group(function() {
    Route::get('/profesis', 'AdminDashboardController@listProfesi')->name('list_profesi');
    Route::post('/profesis/store', 'AdminDashboardController@storeProfesi')->name('store_profesi');
    Route::delete('/profesis/destroy/{id}', 'AdminDashboardController@destroyProfesi')->name('destroy_profesi');
    Route::patch('/profesis/update-nama/{id}', 'AdminDashboardController@updateNamaProfesi')->name('update_profesi');
    Route::resource('/users', 'UserController');
});

// Route untuk relawan
Route::namespace('Relawan')->prefix('relawan')->name('relawan.')->middleware('can:relawan-users', 'can:verified-users')->group(function() {
    Route::resource('programs', 'ProgramController');
});

// Route untuk fundraiser
Route::namespace('Fundraiser')->prefix('fundraiser')->name('fundraiser.')->middleware('can:fundraiser-users', 'can:verified-users')->group(function() {
    Route::get('/', 'FundraiserDashboardController@index')->name('index');
});

// Route Logout
Route::get('/logout', function(){
    // logout user
    Auth::logout();
    // redirect to homepage
    return redirect('/');
});