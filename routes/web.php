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
    return redirect()->route('home');
});

Auth::routes();


Route::prefix('/admin')->name('admin.')->middleware('admin')->group(function(){
  Route::get('/index', 'AdminController@index')->name('index');
  
});

Route::prefix('/kasir')->name('kasir.')->middleware('kasir')->group(function(){
  Route::get('/index', 'KasirController@index')->name('index');
});

Route::prefix('/member')->name('member')->middleware('member')->group(function(){
  Route::get('/','MemberController@index')->name('index');
});

Route::prefix('/products')->name('products.')->group(function(){
  Route::get('/categories/{id}/{slug}', 'HomeController@showCategory')->name('category');
});


Route::get('logout', 'Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('home');