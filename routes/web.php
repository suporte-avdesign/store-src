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


Route::get('/', 'Web\CategoryController@index')->name('home');
Route::get('categorias', 'Web\CategoryController@index')->name('category');

Route::get('404', function () {
    return view('errors.404');
});



Route::get('login','Auth\LoginController@showLoginForm')->name('login');
Route::post('login','Auth\LoginController@login');
Route::post('logout','Auth\LoginController@logout')->name('logout');
Route::post('password/email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::post('password/reset','Auth\ResetPasswordController@reset')->name('password.update');
Route::get('password/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::get('password/reset/{token}','Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::get('register','Auth\RegisterController@register');
Route::post('register','Auth\RegisterController@showRegistrationFor')->name('register');

Route::get('social', 'Web\SocialController@index')->name('social.auth');








/*
|--------------------------------------------------------------------------
| Routes Categories
|--------------------------------------------------------------------------
*/
Route::get('categorias/filtrar/', 'Web\CategoryController@index')->name('category.filter');
Route::get('categories/{section}/{pag}/{num}/', 'Web\CategoryController@infinitScroll')->name('category.infinit');
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
Route::post('cart/update', 'Web\CartController@update')->name('cart.update');
Route::post('cart-endpoint', 'Web\CartController@endpoint')->name('cart.endpoint');
Route::post('cart-shipping', 'Web\CartController@shipping')->name('cart.shipping');
Route::post('cart/add', 'Web\CartController@store')->name('cart.add');
Route::post('cart/fragments', 'Web\CartController@fragments')->name('cart.fragments');
Route::post('cart/add/product', 'Web\CartController@product')->name('cart.product');
Route::post('cart-remove', 'Web\CartController@destroy')->name('cart.remove');
Route::get('cart-undo', 'Web\CartController@undo')->name('cart.undo');


/*
|--------------------------------------------------------------------------
| Routes Wishlist
|--------------------------------------------------------------------------
*/
Route::get('lista-de-desejo', 'Web\WishlistController@index')->name('wishlist');
Route::post('wishlist/store', 'Web\WishlistController@store')->name('wishlist.store');
Route::get('wishlist/create', 'Web\WishlistController@create')->name('wishlist.create');
Route::post('wishlist-remove', 'Web\WishlistController@destroy')->name('wishlist.remove');
Route::get('wishlist-cart', 'Web\WishlistController@cart')->name('wishlist.cart');

/*
|--------------------------------------------------------------------------
| Routes Compare
|--------------------------------------------------------------------------
*/
Route::get('compare', 'Web\CompareController@index')->name('compare');
Route::get('compare/store', 'Web\CompareController@store')->name('compare.store');


/*
|--------------------------------------------------------------------------
| Routes Checkout
|--------------------------------------------------------------------------
*/
Route::get('checkout', 'Web\CheckoutController@index')->name('checkout');
Route::post('endpoint', 'Web\CheckoutController@endpoint')->name('checkout.endpoint');




Auth::routes();


