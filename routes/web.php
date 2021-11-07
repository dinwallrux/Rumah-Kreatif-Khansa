<?php

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

Route::resource('daftar', Auth\RegisterController::class)->only([
    'index', 'store'
]);
Route::resource('login', Auth\LoginController::class)->only([
    'index', 'store'
]);