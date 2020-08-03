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
  Route::get('/user', 'UserController@index')->name('user');
  Route::get('/user/create', 'UserController@create')->name('create');
});

Route::prefix('/kasir')->name('kasir.')->middleware('kasir')->group(function(){
  Route::get('/index', 'KasirController@index')->name('index');
  Route::get('/search', 'KasirController@search')->name('search');
  Route::post('/order', 'KasirController@createOrder')->name('order');
  Route::get('/cancel-order/{order_id}', 'KasirController@deleteOrder')->name('delete.order');
  Route::post('/save-transaction', 'KasirController@saveTransaction')->name('transaction.save');
  Route::get('/add-item/{product_id}', 'KasirController@addItem')->name('add.item');
  Route::post('/add-item-quantity', 'KasirController@addItemQuantity')->name('add.item.quantity');
  Route::get('/remove-item/{product_id}', 'KasirController@removeItem')->name('remove.item');
});


Route::prefix('/member')->name('member.')->middleware('member')->group(function(){
  Route::get('/','HomeController@index')->name('index');
  Route::get('/search', 'MemberController@search')->name('search');
  Route::post('/order', 'MemberController@createOrder')->name('order');
  Route::get('/cancel-order/{order_id}', 'MemberController@deleteOrder')->name('delete.order');
  Route::post('/save-transaction', 'MemberController@saveTransaction')->name('transaction.save');
  Route::get('/add-item/{product_id}', 'MemberController@addItem')->name('add.item');
  Route::post('/add-item-quantity', 'MemberController@addItemQuantity')->name('add.item.quantity');
  Route::get('/remove-item/{product_id}', 'MemberController@removeItem')->name('remove.item');
  Route::get('/shopping-cart', 'MemberController@showCart')->name('cart');
  Route::get('/shopping-cart/add', 'MemberController@saveItem')->name('add.item');
  Route::get('/save-favorite/{product_id}', 'MemberController@saveFavorite')->name('save.favorite');
  Route::get('/remove-favorite/{id}', 'MemberController@removeFavorite')->name('remove.favorite');
  Route::get('/test', 'MemberController@test')->name('test');
});

Route::prefix('/products')->name('products.')->group(function(){
  Route::get('/categories/{id}/{slug}', 'HomeController@showCategory')->name('category');
});


Route::get('logout', 'Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('home');