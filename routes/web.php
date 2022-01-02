<?php

use App\Http\Controllers\OrangTuaController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index')->name('front');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/datepicker', 'HomeController@datepicker')->name('datepicker');

// register
Route::resource('daftar', Auth\RegisterController::class)->only([
    'index', 'store'
]);
// login
Route::resource('login', Auth\LoginController::class)->only([
    'index', 'store'
]);
// logout
Route::get('logout', 'Auth\LoginController@logout')->name('logout')->middleware('auth');

// get address
Route::get('province/{id}/regencies', 'AddressController@getRegencies');
Route::get('province/{id}/regencies/{regencyId}/districts', 'AddressController@getDistricts');

// admin route
Route::middleware(['auth'])->prefix('admin')->group(function(){
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::get('/anak', 'AnakController@index')->name('anak');
    Route::get('orang-tua', 'OrangTuaController@index')->name('orangTua');
});