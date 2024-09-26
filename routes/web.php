<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('clinet.index');
});

Route::get('shop', function () {
    return view('clinet.shop');
});

Route::get('about', function () {
    return view('clinet.about');
});


Route::resource('orders', OrderController::class);









// Route::prefix('admin')
//     ->group(function () {

//         Route::prefix('products')
//             ->as('products.')
//             ->controller(ProductController::class)
//             ->group(function () {
//                 Route::get('/',             'index')->name('index');
//                 Route::get('create',        'create')->name('create');
//                 Route::post('store',        'store')->name('store');
//                 Route::get('{id}',          'show')->name('show');
//                 Route::get('{id}/edit',     'edit')->name('edit');
//                 Route::put('{id}',          'update')->name('update');
//                 Route::delete('{id}',       'destroy')->name('destroy');
//             });
//     });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
