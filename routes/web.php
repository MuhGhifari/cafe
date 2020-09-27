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
  Route::get('/product','HomeController@product')->name('product');
  Route::get('/created','HomeController@created')->name('productcreate');
  Route::post('/stored','HomeController@stored')->name('productstore');
  Route::get('/edited/{$id}','HomeController@edited')->name('productedit');
  Route::delete('/destriyed/{id}','HomeController@destroyed')->name('destroyed');
  Route::get('/laporan', 'HomeController@cetak_pdf')->name('cetak');

 });
 

Route::prefix('/kasir')->name('kasir.')->middleware('kasir')->group(function(){

  Route::get('/index', 'KasirController@index')->name('index');
  Route::get('/online-order', 'KasirController@showOnlinePayment')->name('online.payment');

  Route::get('/search', 'KasirController@search')->name('search');

  Route::post('/order', 'KasirController@createOrder')->name('order');
  Route::get('/cancel-order/{order_id}', 'KasirController@deleteOrder')->name('delete.order');
  Route::get('/add-item/{product_id}', 'KasirController@addItem')->name('add.item');
  Route::post('/add-item-quantity', 'KasirController@addItemQuantity')->name('add.item.quantity');
  Route::get('/remove-item/{product_id}', 'KasirController@removeItem')->name('remove.item');

  Route::post('/save-transaction', 'KasirController@saveTransaction')->name('transaction.save');

  Route::post('/search/online-order', 'KasirController@findOnlineOrder')->name('find.online.order');
});


Route::prefix('/member')->name('member.')->middleware('member')->group(function(){
  Route::get('/','HomeController@index')->name('index');
  Route::get('/search', 'MemberController@search')->name('search');
  Route::post('/order', 'MemberController@createOrder')->name('order');

  Route::get('/favorites', 'MemberController@showFavorites')->name('show.favorites');
  Route::get('/save-favorite/{product_id}', 'MemberController@saveFavorite')->name('save.favorite');
  Route::get('/remove-favorite/{id}', 'MemberController@removeFavorite')->name('remove.favorite');
  
  Route::get('/shopping-cart', 'MemberController@showCart')->name('cart');
  Route::post('/shopping-cart/add', 'MemberController@addItem')->name('add.item');
  Route::post('/add-item-quantity', 'MemberController@addItemQuantity')->name('add.item.quantity');
  Route::get('/remove-item/{order_item_id}', 'MemberController@removeItem')->name('remove.item');

  Route::post('/save-order', 'MemberController@generateInvoice')->name('save.order');
  Route::get('/orders', 'MemberController@showInvoiceList')->name('show.orders');
  Route::get('/invoice/{invoice}', 'MemberController@showInvoice')->name('invoice');
  Route::get('/cancel-order/{order_id}', 'MemberController@cancelOrder')->name('cancel.order');
  Route::get('/show-transaction-detail/{order_id}', 'MemberController@showTransaction')->name('transaction.detail');
  Route::get('/test', 'MemberController@test')->name('test');
});

Route::prefix('/products')->name('products.')->group(function(){
  Route::get('/categories/{id}/{slug}', 'HomeController@showCategory')->name('category');
});


Route::get('logout', 'Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/search', 'HomeController@search')->name('search');
