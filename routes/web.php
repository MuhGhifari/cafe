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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::prefix('/admin')->name('admin.')->middleware('admin')->group(function(){
  Route::get('/index', 'AdminController@index')->name('index');
});

Route::prefix('/kasir')->name('kasir.')->middleware('kasir')->group(function(){
  Route::get('/index', 'KasirController@index')->name('index');
});

Route::get('/home', 'HomeController@index')->name('home');
