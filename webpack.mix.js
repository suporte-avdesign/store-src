const mix = require('laravel-mix');


/*
 |--------------------------------------------------------------------------
 | home-1
 |--------------------------------------------------------------------------
 */
mix.styles('resources/assets/plugins/revslider/css/settings.css', 'public/plugins/revslider/css/settings.min.css');
mix.styles('resources/assets/themes/css/theme-home-1.css', 'public/themes/css/home-1-min.css');
mix.copy('resources/assets/plugins/revslider/fonts/pe-icon-7-stroke', 'public/plugins/revslider/fonts/pe-icon-7-stroke');
mix.copy('resources/assets/plugins/revslider/fonts/revicons', 'public/plugins/revslider/fonts/revicons');
mix.copy('resources/assets/plugins/revslider', 'public/revslider');

mix.scripts([
    'resources/assets/scrips/head/js_active.js',
    'resources/assets/scrips/head/MonsterInsights.js',
    'resources/assets/includes/js/jquery/jquery-migrate.min.js',
    'resources/assets/plugins/jquery-blockui/jquery.blockUI.min.js',
    'resources/assets/plugins/cart/js/add-to-cart.js',
    'resources/assets/plugins/cart/js/avd-add-to-cart.js',
    'resources/assets/scrips/head/scrollMenu.js',
    'resources/assets/scrips/revslider/setREVStartSize.min.js',
    'resources/assets/scrips/carousel/carousel-home-first.js',
    'resources/assets/scrips/carousel/carousel-home-second.js',
    'resources/assets/scrips/carousel/carousel-home-third.js',
    'resources/assets/footer/className.replace.js',
    'resources/assets/scripts/revslider/revslider_showDoubleJqueryError.js',
    'resources/assets/plugins/yith-wishlist/js/jquery.selectBox.min.js',
    'resources/assets/plugins/yith-wishlist/js/jquery.yith-wcwl.js',
    'resources/assets/includes/contact-form-7/js/scripts.js',
    'resources/assets/plugins/revslider/js/jquery.themepunch.tools.min.js',
    'resources/assets/plugins/revslider/js/jquery.themepunch.revolution.min.js',
    'resources/assets/plugins/revslider/js/extensions/revolution.extension.actions.min.js',
    'resources/assets/plugins/revslider/js/extensions/revolution.extension.carousel.min.js',
    'resources/assets/plugins/revslider/js/extensions/revolution.extension.kenburn.min.js',
    'resources/assets/plugins/revslider/js/extensions/revolution.extension.layeranimation.min.js',
    'resources/assets/plugins/revslider/js/extensions/revolution.extension.navigation.min.js',
    'resources/assets/plugins/revslider/js/extensions/revolution.extension.navigation.min.js',
    'resources/assets/plugins/revslider/js/extensions/revolution.extension.parallax.min.js',
    'resources/assets/plugins/revslider/js/extensions/revolution.extension.slideanims.min.js',
    'resources/assets/plugins/revslider/js/extensions/revolution.extension.video.min.js',
    'resources/assets/plugins/js-cookie/js.cookie.js',
    'resources/assets/plugins/frontend/avdesign.js',
    'resources/assets/plugins/cart/js/cart-fragments.js',
    'resources/assets/plugins/isotope/isotope.pkgd.js', // Remover o min
    'resources/assets/plugins/waypoints/waypoints.min.js',
    'resources/assets/plugins/js_composer/js/dist/js_composer_front.min.js',
    'resources/assets/themes/js/theme-org.js',
    'resources/assets/includes/underscore/js/underscore.js',
    'resources/assets/includes/util/avd-util.js',
    'resources/assets/plugins/cart/js/add-to-cart-variation.js',
    'resources/assets/scrips/revslider/rs-plugin-settings-inline-css.js',  // Talvez revslider e no head também
    'resources/assets/scripts/revslider/revsliderOnLoad.js',
    'resources/assets/footer/mc4wp.js'
], 'public/cache/js/home-1.min.js').version();




/*
 |--------------------------------------------------------------------------
 | bootstrap, font-awesome
 |--------------------------------------------------------------------------
 */

mix.styles('node_modules/font-awesome/css/font-awesome.min.css', 'public/font-awesome/css/font-awesome.min.css');
mix.styles('node_modules/bootstrap/dist/css/bootstrap.min.css', 'public/bootstrap/css/bootstrap.min.css');


mix.copy('node_modules/bootstrap/dist/fonts', 'public/bootstrap/fonts');
mix.copy('node_modules/font-awesome/fonts', 'public/font-awesome/fonts');
mix.copy('resources/assets/plugins/prettyPhoto/fonts', 'public/prettyPhoto/fonts');
mix.copy('resources/assets/themes/css/fonts', 'public/css/fonts');

mix.copy('resources/assets/themes/css/images', 'public/css/images');
mix.copy('resources/assets/themes/images', 'public/themes/images');

mix.styles('resources/assets/includes/contact-form-7/css/styles.css', 'public/includes/contact-form-7/css/styles.css');

mix.styles('resources/assets/plugins/prettyPhoto/css/prettyPhoto.css', 'public/plugins/prettyPhoto/css/prettyPhoto.css');
mix.styles('resources/assets/plugins/yith-wishlist/css/jquery.selectBox.css', 'public/plugins/yith-wishlist/css/jquery.selectBox.css');
mix.styles('resources/assets/plugins/yith-wishlist/css/style.css', 'public/plugins/yith-wishlist/css/style.css');
mix.styles('resources/assets/plugins/js_composer/css/js_composer.min.css', 'public/plugins/js_composer/css/js_composer.min.css');
// ie9
mix.styles('resources/assets/plugins/js_composer/css/vc_lte_ie9.min.css', 'public/plugins/js_composer/css/vc_lte_ie9.min.css');
// Contact
mix.styles('resources/assets/plugins/js_composer/css/js_composer_tta.min.css', 'public/plugins/js_composer/css/js_composer_tta.min.css');

mix.styles('resources/assets/plugins/mailchimp/css/form-basic.min.css', 'public/plugins/mailchimp/css/form-basic.min.css');

mix.styles('resources/assets/css/main.css', 'public/css/main.css');










mix.styles('resources/assets/themes/css/styles.css', 'public/themes/css/styles.min.css');
mix.styles('resources/assets/themes/css/theme.css', 'public/themes/css/theme.css');



mix.scripts([
    'resources/assets/scrips/head/js_active.js',
    'resources/assets/scrips/head/MonsterInsights.js',
    'resources/assets/includes/js/jquery/jquery-migrate.min.js',
    'resources/assets/plugins/jquery-blockui/jquery.blockUI.min.js',
    'resources/assets/plugins/cart/js/add-to-cart.js',
    'resources/assets/plugins/cart/js/avd-add-to-cart.js',
    'resources/assets/scrips/head/scrollMenu.js',
    'resources/assets/includes/contact-form-7/js/scripts.js',
    'resources/assets/plugins/js-cookie/js.cookie.js',
    'resources/assets/plugins/frontend/avdesign.js',
    'resources/assets/plugins/cart/js/cart-fragments.js',
    'resources/assets/plugins/yith-wishlist/js/jquery.selectBox.min.js',
    'resources/assets/plugins/yith-wishlist/js/jquery.yith-wcwl.js',
    'resources/assets/plugins/isotope/isotope.pkgd.js', // Remover o min
    'resources/assets/plugins/waypoints/waypoints.min.js',
    'resources/assets/plugins/js_composer/js/dist/js_composer_front.min.js',
    'resources/assets/themes/js/theme-org.js',
    'resources/assets/includes/underscore/js/underscore.js',
    'resources/assets/includes/util/avd-util.js',
    'resources/assets/plugins/cart/js/add-to-cart-variation.js',
    'resources/assets/footer/mc4wp.js'
], 'public/cache/js/main.min.js');


// template
mix.scripts('resources/assets/plugins/google/analytics-frontend.js', 'public/plugins/google/analytics-frontend.min.js');
mix.scripts('resources/assets/includes/js/jquery/jquery.min.js', 'public/includes/js/jquery/jquery.min.js');
mix.scripts('resources/assets/themes/js/html5.min.js', 'public/themes/js/html5.min.js');
mix.scripts('resources/assets/themes/js/device.min.js', 'public/themes/js/device.min.js');






//Product footer
mix.scripts('resources/assets/plugins/zoom/js/jquery.zoom.js', 'public/plugins/zoom/js/jquery.zoom.min.js');
mix.scripts('resources/assets/plugins/product/js/single-product.js', 'public/plugins/product/js/single-product.min.js');


//Cart head
mix.styles('resources/assets/plugins/select2/css/select2.css', 'public/plugins/select2/css/select2.css');
mix.scripts('resources/assets/includes/zxcvbn/js/zxcvbn-async.min.js', 'public/includes/zxcvbn/js/zxcvbn-async.min.js');
//Cart footer
mix.scripts('resources/assets/plugins/address/country-select.js', 'public/plugins/address/country-select.min.js');
mix.scripts('resources/assets/plugins/address/address-i18n.js', 'public/plugins/address/address-i18n.min.js');
mix.scripts('resources/assets/plugins/cart/js/cart.js', 'public/plugins/cart/js/cart.js');
mix.scripts('resources/assets/plugins/select2/js/select2.full.js', 'public/plugins/select2/js/select2.full.min.js');

//Checkout footer
mix.scripts('resources/assets/plugins/checkout/checkout.js', 'public/plugins/checkout/checkout.min.js');

//Account footer
mix.scripts('resources/assets/plugins/account/register.js', 'public/plugins/account/register.min.js');


//Login head
mix.scripts('resources/assets/includes/zxcvbn/js/zxcvbn-async.js', 'public/includes/zxcvbn/js/zxcvbn-async.min.js');
mix.scripts('resources/assets/includes/zxcvbn/js/password-strength-meter.js', 'public/includes/zxcvbn/js/password-strength-meter.min.js');
mix.scripts('resources/assets/plugins/jquery-maskedinput/jquery.maskedinput.min.js', 'public/plugins/jquery-maskedinput/jquery.maskedinput.min.js');
mix.scripts('resources/assets/themes/js/functions.js', 'public/themes/js/functions.min.js');

mix.scripts('resources/assets/plugins/pagseguro/payment.js', 'public/plugins/pagseguro/payment.min.js');

//Contact footer
mix.scripts('resources/assets/plugins/avdesign/js/avd-tabs-accordion.js', 'public/plugins/avdesign/js/avd-tabs-accordion.min.js');


