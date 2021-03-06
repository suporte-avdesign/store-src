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


Route::get('testes/contato', 'Web\TestesController@contato');
Route::get('testes/popoups', 'Web\TestesController@popoups');
Route::any('json', 'Web\JsonController@index')->name('json');

Route::get('/', 'Web\HomeController@index')->name('home');



Route::get('404', function () {
    return view('errors.404');
});


Auth::routes();




Route::post('logout','Auth\LoginController@logout')->name('logout');
Route::post('password/email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::post('password/reset','Auth\ResetPasswordController@reset')->name('password.update');
Route::get('password/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::get('password/reset/{token}','Auth\ResetPasswordController@showResetForm')->name('password.reset');

/*
|--------------------------------------------------------------------------
| Routes Register
|--------------------------------------------------------------------------
*/
Route::post('register', 'Auth\RegisterController@register')->name('register');
Route::get('cadastro/{email}/{token}', 'Auth\RegisterController@verifyToken')->name('register.confirm');


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
| Routes Coupon
|--------------------------------------------------------------------------
*/
Route::any('coupon/store', 'Web\CouponController@store')->name('coupon.store');

/*
|--------------------------------------------------------------------------
| Routes Cart
|--------------------------------------------------------------------------
*/
Route::get('cart', 'Web\CartController@index')->name('cart');
Route::post('cart/add/product', 'Web\CartController@product')->name('cart.product');
Route::post('cart-endpoint', 'Web\CartController@endpoint')->name('cart.endpoint');
Route::post('cart/update', 'Web\CartController@update')->name('cart.update');

Route::post('cart/add', 'Web\CartController@store')->name('cart.add');
Route::post('cart/fragments', 'Web\CartController@fragments')->name('cart.fragments');
Route::get('cart-undo', 'Web\CartController@undo')->name('cart.undo');

Route::any('cart-remove', 'Web\CartController@destroy')->name('cart.remove');

/*
|--------------------------------------------------------------------------
| Routes Shipping Method
|--------------------------------------------------------------------------
*/
Route::post('shipping/method', 'Web\ConfigShippingController@method')->name('shipping.method');
Route::post('shipping/calculator', 'Web\ConfigShippingController@calculateFreight')->name('shipping.calculator');


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
Route::group(['prefix' => 'checkout',  'middleware' => 'check-items'], function () {
    Route::get('/', 'Web\CheckoutController@index')->name('checkout');
    Route::post('/', 'Web\CheckoutController@login')->name('checkout.login')->middleware("throttle:5,1");;
    Route::post('review', 'Web\CheckoutController@review')->name('checkout.review');
    Route::post('store', 'Web\CheckoutController@store')->name('checkout.store');
    Route::get('{email}/{token}', 'Web\CheckoutController@verifyToken')->name('checkout.confirm');

});

/*
|--------------------------------------------------------------------------
| Routes PagSeguro
|--------------------------------------------------------------------------
*/
Route::get('pagseguro-card', 'Web\PagSeguroController@card')->name('pagseguro.card');
Route::post('pagseguro-card-transaction', 'Web\PagSeguroController@cardTransaction')->name('pagseguro.card.transaction');

Route::post('pagseguro-billet', 'Web\PagSeguroController@billet')->name('pagseguro.billet');
Route::post('pagseguro-transparente', 'Web\PagSeguroController@transparenteCode')->name('pagseguro.transparente.code');

/*
|--------------------------------------------------------------------------
| Routes PagSeguro Testes
|--------------------------------------------------------------------------
*/
Route::get('pagseguro', 'Web\PagSeguroController@pagseguro')->name('pagseguro');
Route::get('pagseguro-button', 'Web\PagSeguroController@button')->name('pagseguro-button');
Route::get('pagseguro-lightbox', 'Web\PagSeguroController@lightbox')->name('pagseguro.lightbox');
Route::post('pagseguro-lightbox', 'Web\PagSeguroController@lightboxCode')->name('pagseguro.lightbox.code');
Route::get('pagseguro-transparente', 'Web\PagSeguroController@transparente')->name('pagseguro.transparente');

/*
|--------------------------------------------------------------------------
| Routes Orders
|--------------------------------------------------------------------------
*/
Route::get('order/received/{reference}/{token}', 'Web\OrderController@index')->name('order.received');
Route::post('cash', 'Web\OrderController@paymentCash')->name('order.cash');






/*
|--------------------------------------------------------------------------
| Routes Pages
|--------------------------------------------------------------------------
*/

Route::get('termos-e-condicoes', 'Web\PagesController@terms')->name('terms-conditions');
Route::get('politica-de-privacidade', 'Web\PagesController@privacy')->name('privacy-policy');
Route::get('sobre-entregas', 'Web\PagesController@deliveries')->name('deliveries');
Route::get('trocas-e-devolucoes', 'Web\PagesController@deliveryReturn')->name('delivery-return');
Route::get('forma-de-pagamento', 'Web\PagesController@payment')->name('form-payment');
Route::get('contrato-de-compra-e-venda', 'Web\PagesController@contract')->name('contract');



Route::get('contato', 'Web\ContactController@index')->name('contact');
Route::post('contato', 'Web\ContactController@store')->name('contact');






/*
|--------------------------------------------------------------------------
| Routes Login Post 5 tentativas em 1 minuto
| Personalizar mensagem no app/Exceptions/Handler
|--------------------------------------------------------------------------
*/

Route::get('login','Auth\LoginController@showLoginForm')->name('login');
Route::post('login','Auth\LoginController@pageLogin')->name('login')->middleware("throttle:5,1");
Route::get('recuperar-senha','Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::get('password/reset/{token}','Auth\ResetPasswordController@showResetForm')->name('password.reset');

/*
|--------------------------------------------------------------------------
| Routes Register
|--------------------------------------------------------------------------
*/
Route::get('cadastro','Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('cadastro','Auth\RegisterController@register')->name('register');

/*
|--------------------------------------------------------------------------
| Routes Protected
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'minha-conta',  'middleware' => 'auth'], function () {

    Route::get('/', 'Web\AccountController@index')->name('account');
    Route::get('lista-de-desejo', 'Web\AccountController@wishlist')->name('account.wishlist');
    Route::get('pedidos', 'Web\AccountController@order')->name('account.order');
    Route::get('pedido/{reference}', 'Web\AccountController@orderView')->name('order.view');
    Route::get('perfil', 'Web\AccountController@profile')->name('account.profile');
    Route::put('perfil', 'Web\AccountController@profileUpdate')->name('account.profile');
    Route::get('endereco-de-entrega', 'Web\AccountController@address')->name('account.address');
    Route::put('endereco-de-entrega', 'Web\AccountController@addressUpdate')->name('address.update');
});

//



