const mix = require('laravel-mix');

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
mix.styles('resources/assets/plugins/mailchimp/css/form-basic.min.css', 'public/plugins/mailchimp/css/form-basic.min.css');

mix.styles('resources/assets/css/main.css', 'public/css/main.css');

// ie9
mix.styles('resources/assets/plugins/js_composer/css/vc_lte_ie9.min.css', 'public/plugins/js_composer/css/vc_lte_ie9.min.css');

mix.styles('resources/assets/themes/css/styles.css', 'public/themes/css/styles.min.css');
mix.styles('resources/assets/themes/css/theme.css', 'public/themes/css/theme.css');

// head
mix.scripts('resources/assets/plugins/google/analytics-frontend.js', 'public/plugins/google/analytics-frontend.min.js');
mix.scripts('resources/assets/includes/js/jquery/jquery.min.js', 'public/includes/js/jquery/jquery.min.js');
mix.scripts('resources/assets/includes/js/jquery/jquery-migrate.min.js', 'public/includes/js/jquery/jquery-migrate.min.js');
mix.scripts('resources/assets/plugins/jquery-blockui/jquery.blockUI.min.js', 'public/plugins/jquery-blockui/jquery.blockUI.min.js');
mix.scripts('resources/assets/plugins/cart/js/add-to-cart.min.js', 'public/plugins/cart/js/add-to-cart.min.js');
mix.scripts('resources/assets/plugins/cart/js/avd-add-to-cart.js', 'public/plugins/cart/js/avd-add-to-cart.js');
mix.scripts('resources/assets/themes/js/html5.min.js', 'public/themes/js/html5.min.js');
mix.scripts('resources/assets/themes/js/device.min.js', 'public/themes/js/device.min.js');

//footer
mix.scripts('resources/assets/includes/contact-form-7/js/scripts.js', 'public/includes/contact-form-7/js/scripts.js');
mix.scripts('resources/assets/plugins/js-cookie/js.cookie.min.js', 'public/plugins/js-cookie/js.cookie.min.js');
mix.scripts('resources/assets/plugins/frontend/avdesign.min.js', 'public/plugins/frontend/avdesign.min.js');
mix.scripts('resources/assets/plugins/cart/js/cart-fragments.min.js', 'public/plugins/cart/js/cart-fragments.min.js');
mix.scripts('resources/assets/plugins/yith-wishlist/js/jquery.selectBox.min.js', 'public/plugins/yith-wishlist/js/jquery.selectBox.min.js');
mix.scripts('resources/assets/plugins/yith-wishlist/js/jquery.yith-wcwl.js', 'public/plugins/yith-wishlist/js/jquery.yith-wcwl.js');
mix.scripts('resources/assets/plugins/isotope/isotope.pkgd.min.js', 'public/plugins/isotope/isotope.pkgd.min.js');
mix.scripts('resources/assets/plugins/waypoints/waypoints.min.js', 'public/plugins/waypoints/waypoints.min.js');
mix.scripts('resources/assets/plugins/js_composer/js/js_composer_front.min.js', 'public/plugins/js_composer/js/js_composer_front.min.js');
mix.scripts('resources/assets/themes/js/theme-org.js', 'public/themes/js/theme-org.js');
mix.scripts('resources/assets/includes/underscore/js/underscore.min.js', 'public/includes/underscore/js/underscore.min.js');
mix.scripts('resources/assets/includes/util/avd-util.min.js', 'public/includes/util/avd-util.min.js');
mix.scripts('resources/assets/plugins/cart/js/add-to-cart-variation.js', 'public/plugins/cart/js/add-to-cart-variation.min.js');

//Product
mix.scripts('resources/assets/plugins/zoom/js/jquery.zoom.js', 'public/plugins/zoom/js/jquery.zoom.min.js');
mix.scripts('resources/assets/plugins/product/js/single-product.js', 'public/plugins/product/js/single-product.min.js');

/*
mix.sass([
    'resources/assets/css/login.css'
], 'public/css/login.min.css');

*/
