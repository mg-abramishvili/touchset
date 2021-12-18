<?php

use Illuminate\Support\Facades\Route;

Route::get('/','App\Http\Controllers\HomeController@index')->name('home');

Route::get('p/{slug}','App\Http\Controllers\PageController@page_item')->name('page');

Route::get('categories','App\Http\Controllers\CategoryController@index')->name('categories');
Route::get('category/{slug}','App\Http\Controllers\CategoryController@category_item')->name('category_item');

Route::get('product/{slug}','App\Http\Controllers\ProductController@product_item')->name('product_item');

Route::get('cart','App\Http\Controllers\CartController@cart')->name('cart');
Route::get('cart_data','App\Http\Controllers\CartController@cart_data')->name('cart_data');
Route::post('add-to-cart/{product}','App\Http\Controllers\CartController@add')->name('add_to_cart');
Route::get('remove-from-cart/{product}','App\Http\Controllers\CartController@remove')->name('remove_from_cart');
Route::post('update-cart','App\Http\Controllers\CartController@update_cart');
Route::get('update-cart-item-addons/{sku}/{addons}','App\Http\Controllers\CartController@update_cart_item_addons');
Route::get('checkout','App\Http\Controllers\CartController@checkout')->name('checkout');

Route::post('order-store','App\Http\Controllers\OrderController@order_store');

Route::get('search','App\Http\Controllers\ProductController@product_search')->name('product_search');

Route::get('admin','App\Http\Controllers\Admin\AdminController@index')->name('admin_home')->middleware('auth');

// ADMIN PRODUCTS
Route::get('admin/products','App\Http\Controllers\Admin\ProductController@index')->name('admin_products')->middleware('auth');
Route::get('admin/products/create','App\Http\Controllers\Admin\ProductController@create')->name('admin_products_create')->middleware('auth');
Route::get('admin/product/{id}','App\Http\Controllers\Admin\ProductController@edit')->name('admin_product_edit')->middleware('auth');
Route::get('_admin/product/{id}','App\Http\Controllers\Admin\ProductController@item')->middleware('auth');
Route::post('_admin/products','App\Http\Controllers\Admin\ProductController@store')->middleware('auth');
Route::put('_admin/product/{id}','App\Http\Controllers\Admin\ProductController@update')->middleware('auth');
Route::get('_admin/product/{id}/delete','App\Http\Controllers\Admin\ProductController@delete')->middleware('auth');
Route::post('_admin/products/file/{method}','App\Http\Controllers\Admin\ProductController@file')->middleware('auth');
Route::get('admin/products-update-prices','App\Http\Controllers\Admin\ProductController@updatePrices')->middleware('auth');

// ADMIN CATEGORIES
Route::get('admin/categories','App\Http\Controllers\Admin\CategoryController@index')->name('admin_categories')->middleware('auth');
Route::get('admin/categories/create','App\Http\Controllers\Admin\CategoryController@create')->name('admin_categories_create')->middleware('auth');
Route::get('admin/category/{id}','App\Http\Controllers\Admin\CategoryController@edit')->name('admin_category_edit')->middleware('auth');
Route::get('_admin/categories','App\Http\Controllers\Admin\CategoryController@index_data')->middleware('auth');
Route::get('_admin/category/{id}','App\Http\Controllers\Admin\CategoryController@item')->middleware('auth');
Route::post('_admin/categories','App\Http\Controllers\Admin\CategoryController@store')->middleware('auth');
Route::put('_admin/category/{id}','App\Http\Controllers\Admin\CategoryController@update')->middleware('auth');
Route::get('_admin/category/{id}/delete','App\Http\Controllers\Admin\CategoryController@delete')->middleware('auth');
Route::post('_admin/categories/file/{method}','App\Http\Controllers\Admin\CategoryController@file')->middleware('auth');

// ADMIN ORDERS
Route::get('admin/orders','App\Http\Controllers\Admin\OrderController@index')->name('admin_orders')->middleware('auth');
Route::get('admin/order/{id}','App\Http\Controllers\Admin\OrderController@item')->name('admin_order')->middleware('auth');

// ADMIN ATTRIBUTES
Route::get('admin/attributes','App\Http\Controllers\Admin\AttributeController@index')->name('admin_attributes')->middleware('auth');
Route::get('admin/attributes/create','App\Http\Controllers\Admin\AttributeController@create')->name('admin_attributes_create')->middleware('auth');
Route::get('admin/attribute/{id}','App\Http\Controllers\Admin\AttributeController@edit')->name('admin_attribute_edit')->middleware('auth');
Route::get('_admin/attributes','App\Http\Controllers\Admin\AttributeController@index_data')->middleware('auth');
Route::get('_admin/attribute/{id}','App\Http\Controllers\Admin\AttributeController@item')->middleware('auth');
Route::post('_admin/attributes','App\Http\Controllers\Admin\AttributeController@store')->middleware('auth');
Route::put('_admin/attribute/{id}','App\Http\Controllers\Admin\AttributeController@update')->middleware('auth');
Route::get('_admin/attribute/{id}/delete','App\Http\Controllers\Admin\AttributeController@delete')->middleware('auth');

// ADMIN ADDONS
Route::get('admin/addons','App\Http\Controllers\Admin\AddonController@index')->name('admin_addons')->middleware('auth');
Route::get('admin/addons/create','App\Http\Controllers\Admin\AddonController@create')->name('admin_addons_create')->middleware('auth');
Route::get('admin/addon/{id}','App\Http\Controllers\Admin\AddonController@edit')->name('admin_addon_edit')->middleware('auth');
Route::get('_admin/addons','App\Http\Controllers\Admin\AddonController@index_data')->middleware('auth');
Route::post('_admin/addons','App\Http\Controllers\Admin\AddonController@store')->middleware('auth');
Route::put('_admin/addon/{id}','App\Http\Controllers\Admin\AddonController@update')->middleware('auth');
Route::get('_admin/addon/{id}/delete','App\Http\Controllers\Admin\AddonController@delete')->middleware('auth');

// ADMIN PAGES
Route::get('admin/pages','App\Http\Controllers\Admin\PageController@index')->name('admin_pages')->middleware('auth');
Route::get('admin/pages/create','App\Http\Controllers\Admin\PageController@pages_create')->name('admin_pages_create')->middleware('auth');
Route::post('admin/pages','App\Http\Controllers\Admin\PageController@pages_store')->name('admin_pages_store')->middleware('auth');
Route::get('admin/page/{id}','App\Http\Controllers\Admin\PageController@page_item_edit')->name('admin_page_edit')->middleware('auth');
Route::get('admin/page/{id}/delete','App\Http\Controllers\Admin\PageController@page_item_delete')->name('admin_page_delete')->middleware('auth');
Route::put('admin/page/{id}','App\Http\Controllers\Admin\PageController@page_item_update')->name('admin_page_update')->middleware('auth');

// ADMIN SETTINGS
Route::get('admin/settings','App\Http\Controllers\Admin\SettingController@index')->name('admin_settings')->middleware('auth');
Route::get('_admin/settings','App\Http\Controllers\Admin\SettingController@index_data')->middleware('auth');
Route::put('_admin/setting/{id}','App\Http\Controllers\Admin\SettingController@settings_update')->middleware('auth');

Auth::routes();