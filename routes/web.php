<?php

use Illuminate\Support\Facades\Route;

Route::get('/','App\Http\Controllers\PageController@home')->name('home');
Route::get('contacts','App\Http\Controllers\PageController@contacts')->name('contacts');

Route::get('categories','App\Http\Controllers\CategoryController@index')->name('categories');
Route::get('category/{id}','App\Http\Controllers\CategoryController@category_item')->name('category_item');

Route::get('product/{id}','App\Http\Controllers\ProductController@product_item')->name('product_item');

Auth::routes();