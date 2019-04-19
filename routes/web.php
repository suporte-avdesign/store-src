<?php

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
    return view('categories.category-1');
});


/*
|--------------------------------------------------------------------------
| Routes Categories
|--------------------------------------------------------------------------
*/
Route::get('categories', 'Web\CategoryController@index')->name('category');

/*
|--------------------------------------------------------------------------
| Routes Products
|--------------------------------------------------------------------------
*/
Route::get('product/{category}/{section}/{slug}', 'Web\ProductController@index')->name('product');
Route::post('product/show', 'Web\ProductController@show')->name('product.show');
Route::get('product/search', 'Web\ProductController@search')->name('product.search');


/*
|--------------------------------------------------------------------------
| Routes Cart
|--------------------------------------------------------------------------
*/
Route::get('cart', 'Web\CartController@index')->name('cart');
Route::post('cart/add', 'Web\CartController@store')->name('cart.add');
Route::post('cart/fragments', 'Web\CartController@fragments')->name('cart.fragments');
Route::post('cart/add/product', 'Web\CartController@addProduct')->name('cart.add.product');
Route::post('cart/update', 'Web\CartController@update')->name('cart.update');
Route::post('cart/remove', 'Web\CartController@destroy')->name('cart.remove');
Route::get('cart/undo/{id}', 'Web\CartController@undo')->name('cart.undo');


/*
|--------------------------------------------------------------------------
| Routes Wishlist
|--------------------------------------------------------------------------
*/
Route::post('wishlist/store', 'Web\WishlistController@store')->name('wishlist.store');
Route::get('wishlist/create', 'Web\WishlistController@create')->name('wishlist.create');

/*
|--------------------------------------------------------------------------
| Routes Compare
|--------------------------------------------------------------------------
*/
Route::post('compare/store', 'Web\CompareController@store')->name('compare.store');