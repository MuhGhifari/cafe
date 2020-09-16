<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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
  Route::get('/user', 'AdminController@user')->name('user');
  Route::get('/create','AdminController@create')->name('create');
  Route::post('/store','AdminController@store')->name('store');
  Route::get('/edit/{id}','AdminController@edit')->name('edit');
  Route::patch('/update/{id}', 'AdminController@update')->name('update');
  Route::delete('/destroy/{id}','AdminController@destroy')->name('destroy');


  // Products
  Route::get('/product','AdminController@product')->name('product');
  Route::get('/created','AdminController@created')->name('productcreate');
  Route::post('/stored','AdminController@stored')->name('productstore');
  Route::get('/edited/{$id}','AdminController@edited')->name('productedit');
  Route::delete('/destroyed/{id}','AdminController@destroyed')->name('destroyed');
  Route::get('/laporan', 'AdminController@cetak_pdf')->name('cetak');
 

 });
 

Route::prefix('/kasir')->name('kasir.')->middleware('kasir')->group(function(){
  Route::get('/index', 'KasirController@index')->name('index');
  
});

Route::prefix('/member')->name('member.')->middleware('member')->group(function(){
  Route::get('/','MemberController@index')->name('index');
});

Route::prefix('/products')->name('products.')->group(function(){
  Route::get('/categories/{id}/{slug}', 'HomeController@showCategory')->name('category');
});


Route::get('logout', 'Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('home');