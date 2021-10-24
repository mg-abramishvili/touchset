<?php

use Illuminate\Support\Facades\Route;

Route::get('/','App\Http\Controllers\HomeController@index')->name('home');

Route::get('p/{slug}','App\Http\Controllers\PageController@page_item')->name('page');

Route::get('categories','App\Http\Controllers\CategoryController@index')->name('categories');
Route::get('category/{id}','App\Http\Controllers\CategoryController@category_item')->name('category_item');

Route::get('product/{id}','App\Http\Controllers\ProductController@product_item')->name('product_item');

Route::get('cart','App\Http\Controllers\CartController@cart')->name('cart');
Route::get('cart_data','App\Http\Controllers\CartController@cart_data')->name('cart_data');
Route::get('add-to-cart/{product}','App\Http\Controllers\CartController@add')->name('add_to_cart');
Route::get('remove-from-cart/{product}','App\Http\Controllers\CartController@remove')->name('remove_from_cart');
Route::get('update-cart/{product}/{quantity}','App\Http\Controllers\CartController@update')->name('update_cart');

Route::get('search','App\Http\Controllers\ProductController@product_search')->name('product_search');

// ADMIN PRODUCTS
Route::get('admin','App\Http\Controllers\AdminController@index')->name('admin_home')->middleware('auth');
Route::get('admin/products','App\Http\Controllers\AdminProductController@index')->name('admin_products')->middleware('auth');
Route::get('admin/products/create','App\Http\Controllers\AdminProductController@products_create')->name('admin_products_create')->middleware('auth');
Route::post('admin/products','App\Http\Controllers\AdminProductController@products_store')->name('admin_products_store')->middleware('auth');
Route::get('admin/product/{id}','App\Http\Controllers\AdminProductController@product_item_edit')->name('admin_product_edit')->middleware('auth');
Route::put('admin/product/{id}','App\Http\Controllers\AdminProductController@product_item_update')->name('admin_product_update')->middleware('auth');
Route::post('admin/products/file/{method}','App\Http\Controllers\AdminProductController@file')->middleware('auth');

// ADMIN ATTRIBUTES
Route::get('admin/attributes','App\Http\Controllers\AdminAttributeController@index')->name('admin_attributes')->middleware('auth');
Route::get('admin/attributes/create','App\Http\Controllers\AdminAttributeController@attributes_create')->name('admin_attributes_create')->middleware('auth');
Route::post('admin/attributes','App\Http\Controllers\AdminAttributeController@attributes_store')->name('admin_attributes_store')->middleware('auth');
Route::get('admin/attribute/{id}','App\Http\Controllers\AdminAttributeController@attribute_item_edit')->name('admin_attribute_edit')->middleware('auth');
Route::put('admin/attribute/{id}','App\Http\Controllers\AdminAttributeController@attribute_item_update')->name('admin_attribute_update')->middleware('auth');

Auth::routes();