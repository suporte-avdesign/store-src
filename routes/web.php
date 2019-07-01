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


Route::get('/', 'Web\HomeController@index')->name('home');



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
| Routes Sections
|--------------------------------------------------------------------------
*/
Route::get(setRoute('section').'{slug}', 'Web\SectionController@index');
Route::get(setRoute('section').'{slug}/filtrar/', 'Web\SectionController@filter');
Route::get(setRoute('section').'{slug}/{pag}/{num}/', 'Web\SectionController@infinitScroll');

Route::post('section-tabs', 'Web\SectionController@tabs')->name('section.tabs');



/*
|--------------------------------------------------------------------------
| Routes Categories
|--------------------------------------------------------------------------
*/
Route::get(setRoute('category').'{slug}', 'Web\CategoryController@index');
Route::get(setRoute('category').'{slug}/filtrar/', 'Web\CategoryController@filter');
Route::get(setRoute('category').'{slug}/{pag}/{num}/', 'Web\CategoryController@infinitScroll');
/*
|--------------------------------------------------------------------------
| Routes Products
|--------------------------------------------------------------------------
*/

Route::post(setRoute('product').'show', 'Web\ProductController@show')->name('show');

Route::get(setRoute('product').'search', 'Web\ImageColorController@search');
/*
|--------------------------------------------------------------------------
| Routes Colors
|--------------------------------------------------------------------------
*/
Route::get(setRoute('color').'{slug}', 'Web\ImageColorController@index');

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
Route::get('compare/{page}/{id}', 'Web\CompareController@destroy')->name('compare.remove');
Route::delete('compare/{page}/{id}', 'Web\CompareController@destroy');


/*
|--------------------------------------------------------------------------
| Routes Checkout
|--------------------------------------------------------------------------
*/
Route::get('checkout', 'Web\CheckoutController@index')->name('checkout');
Route::post('checkout', 'Web\CheckoutController@login')->name('checkout.login');
Route::post('checkout-endpoint', 'Web\CheckoutController@endpoint')->name('checkout.endpoint');
Route::post('checkout-store', 'Web\CheckoutController@store')->name('checkout.store');
Route::get('checkout/{order}/{id}', 'Web\CheckoutController@show')->name('checkout.received');


/*
|--------------------------------------------------------------------------
| Routes Pages
|--------------------------------------------------------------------------
*/

Route::get('termos-e-condicoes', 'Web\PagesController@terms')->name('terms-conditions');
Route::get('politica-de-privacidade', 'Web\PagesController@privacy')->name('privacy-policy');


Route::get('contato', 'Web\ContactController@index')->name('contact');
Route::post('contato', 'Web\ContactController@store')->name('contact.store');


/*
|--------------------------------------------------------------------------
| Routes Pages
|--------------------------------------------------------------------------
*/
Route::get('minha-conta/', 'Web\AccountController@index')->name('account');
Route::get('minha-conta/lista-de-desejo', 'Web\AccountController@wishlist')->name('account.wishlist');
Route::get('minha-conta/pedidos', 'Web\AccountController@order')->name('account.order');
Route::get('minha-conta/pedido/{id}', 'Web\AccountController@orderView')->name('order.view');
Route::match(['get', 'put'], 'minha-conta/perfil', 'Web\AccountController@profile')->name('account.profile');
Route::get('minha-conta/endereco-de-entrega', 'Web\AccountController@address')->name('account.address');
Route::put('minha-conta/endereco-de-entrega/alterar', 'Web\AccountController@addressUpdate')->name('address.update');



Auth::routes();


