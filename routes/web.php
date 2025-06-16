<?php

use App\Http\Controllers\ProductController;
use App\Http\Middleware\Member;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('home');
});

// Auth routes (use Laravel UI, Breeze, or Jetstream for this)
Auth::routes();

Route::prefix('/admin')->name('admin.')->middleware('admin')->group(function () {
    Route::get('/index', [AdminController::class, 'index'])->name('index');
    Route::get('/user', [AdminController::class, 'user'])->name('user');
    Route::get('/create', [AdminController::class, 'create'])->name('create');
    Route::post('/store', [AdminController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('edit');
    Route::patch('/update/{id}', [AdminController::class, 'update'])->name('update');
    Route::delete('/destroy/{id}', [AdminController::class, 'destroy'])->name('destroy');

    // Products
    Route::get('/product', [AdminController::class, 'product'])->name('product');
    Route::get('/created', [AdminController::class, 'created'])->name('productcreate');
    Route::post('/stored', [AdminController::class, 'stored'])->name('productstore');
    Route::get('/edited/{id}', [AdminController::class, 'edited'])->name('productedit');
    Route::delete('/destroyed/{id}', [AdminController::class, 'destroyed'])->name('destroyed');
    Route::get('/laporan', [AdminController::class, 'cetak_pdf'])->name('cetak');
});

Route::prefix('/kasir')->name('kasir.')->middleware('kasir')->group(function () {
    Route::get('/index', [KasirController::class, 'index'])->name('index');
    Route::get('/online-order', [KasirController::class, 'showOnlinePayment'])->name('online.payment');
    Route::get('/search', [KasirController::class, 'search'])->name('search');
    Route::post('/order', [KasirController::class, 'createOrder'])->name('order');
    Route::get('/cancel-order/{order_id}', [KasirController::class, 'deleteOrder'])->name('delete.order');
    Route::get('/add-item/{product_id}', [KasirController::class, 'addItem'])->name('add.item');
    Route::post('/add-item-quantity', [KasirController::class, 'addItemQuantity'])->name('add.item.quantity');
    Route::get('/remove-item/{product_id}', [KasirController::class, 'removeItem'])->name('remove.item');
    Route::post('/save-transaction', [KasirController::class, 'saveTransaction'])->name('transaction.save');
    Route::post('/search/online-order', [KasirController::class, 'findOnlineOrder'])->name('find.online.order');
});

Route::prefix('/member')->name('member.')->middleware(Member::class)->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/search', [MemberController::class, 'search'])->name('search');
    Route::post('/order', [MemberController::class, 'createOrder'])->name('order');
    Route::get('/favorites', [MemberController::class, 'showFavorites'])->name('show.favorites');
    Route::get('/save-favorite/{product_id}', [MemberController::class, 'saveFavorite'])->name('save.favorite');
    Route::get('/remove-favorite/{id}', [MemberController::class, 'removeFavorite'])->name('remove.favorite');
    Route::get('/shopping-cart', [MemberController::class, 'showCart'])->name('cart');
    Route::post('/shopping-cart/add', [MemberController::class, 'addItem'])->name('add.item');
    Route::post('/add-item-quantity', [MemberController::class, 'addItemQuantity'])->name('add.item.quantity');
    Route::get('/remove-item/{order_item_id}', [MemberController::class, 'removeItem'])->name('remove.item');
    Route::post('/save-order', [MemberController::class, 'generateInvoice'])->name('save.order');
    Route::get('/orders', [MemberController::class, 'showInvoiceList'])->name('show.orders');
    Route::get('/invoice/{invoice}', [MemberController::class, 'showInvoice'])->name('invoice');
    Route::get('/cancel-order/{order_id}', [MemberController::class, 'cancelOrder'])->name('cancel.order');
    Route::get('/show-transaction-detail/{order_id}', [MemberController::class, 'showTransaction'])->name('transaction.detail');
    Route::get('/test', [MemberController::class, 'test'])->name('test');
});

Route::prefix('/products')->name('products.')->group(function () {
    Route::get('/categories/{id}/{slug}', [CategoryController::class, 'showCategory'])->name('category');
});

Route::get('logout', [LoginController::class, 'logout']);
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/search', [ProductController::class, 'search'])->name('search');