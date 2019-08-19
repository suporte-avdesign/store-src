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
// ie9
mix.styles('resources/assets/plugins/js_composer/css/vc_lte_ie9.min.css', 'public/plugins/js_composer/css/vc_lte_ie9.min.css');
// Contact
mix.styles('resources/assets/plugins/js_composer/css/js_composer_tta.min.css', 'public/plugins/js_composer/css/js_composer_tta.min.css');

mix.styles('resources/assets/plugins/mailchimp/css/form-basic.min.css', 'public/plugins/mailchimp/css/form-basic.min.css');

mix.styles('resources/assets/css/main.css', 'public/css/main.css');


// Home
mix.styles('resources/assets/plugins/revslider/css/settings.css', 'public/plugins/revslider/css/settings.min.css');
mix.styles('resources/assets/themes/css/theme-home-1.css', 'public/themes/css/home-1-min.css');
mix.copy('resources/assets/plugins/revslider/fonts/pe-icon-7-stroke', 'public/fonts/pe-icon-7-stroke');
mix.copy('resources/assets/plugins/revslider/fonts/revicons', 'public/fonts/revicons');



mix.scripts('resources/assets/plugins/revslider/js/jquery.themepunch.tools.min.js', 'public/plugins/revslider/js/jquery.themepunch.tools.min.js');
mix.scripts('resources/assets/plugins/revslider/js/jquery.themepunch.revolution.min.js', 'public/plugins/revslider/js/jquery.themepunch.revolution.min.js');
mix.scripts('resources/assets/plugins/revslider/js/extensions/revolution.extension.actions.min.js', 'public/plugins/revslider/js/extensions/revolution.extension.actions.min.js');
mix.scripts('resources/assets/plugins/revslider/js/extensions/revolution.extension.carousel.min.js', 'public/plugins/revslider/js/extensions/revolution.extension.carousel.min.js');
mix.scripts('resources/assets/plugins/revslider/js/extensions/revolution.extension.kenburn.min.js', 'public/plugins/revslider/js/extensions/revolution.extension.kenburn.min.js');
mix.scripts('resources/assets/plugins/revslider/js/extensions/revolution.extension.layeranimation.min.js', 'public/plugins/revslider/js/extensions/revolution.extension.layeranimation.min.js');
mix.scripts('resources/assets/plugins/revslider/js/extensions/revolution.extension.migration.min.js', 'public/plugins/revslider/js/extensions/revolution.extension.migration.min.js');
mix.scripts('resources/assets/plugins/revslider/js/extensions/revolution.extension.navigation.min.js', 'public/plugins/revslider/js/extensions/revolution.extension.navigation.min.js');
mix.scripts('resources/assets/plugins/revslider/js/extensions/revolution.extension.parallax.min.js', 'public/plugins/revslider/js/extensions/revolution.extension.parallax.min.js');
mix.scripts('resources/assets/plugins/revslider/js/extensions/revolution.extension.slideanims.min.js', 'public/plugins/revslider/js/extensions/revolution.extension.slideanims.min.js');
mix.scripts('resources/assets/plugins/revslider/js/extensions/revolution.extension.video.min.js', 'public/plugins/revslider/js/extensions/revolution.extension.video.min.js');







mix.styles('resources/assets/themes/css/styles.css', 'public/themes/css/styles.min.css');
mix.styles('resources/assets/themes/css/theme.css', 'public/themes/css/theme.css');

// template
mix.scripts('resources/assets/plugins/google/analytics-frontend.js', 'public/plugins/google/analytics-frontend.min.js');
mix.scripts('resources/assets/includes/js/jquery/jquery.min.js', 'public/includes/js/jquery/jquery.min.js');
mix.scripts('resources/assets/includes/js/jquery/jquery-migrate.min.js', 'public/includes/js/jquery/jquery-migrate.min.js');
mix.scripts('resources/assets/plugins/jquery-blockui/jquery.blockUI.min.js', 'public/plugins/jquery-blockui/jquery.blockUI.min.js');
mix.scripts('resources/assets/plugins/cart/js/add-to-cart.js', 'public/plugins/cart/js/add-to-cart.min.js');
mix.scripts('resources/assets/plugins/cart/js/avd-add-to-cart.js', 'public/plugins/cart/js/avd-add-to-cart.js');
mix.scripts('resources/assets/themes/js/html5.min.js', 'public/themes/js/html5.min.js');
mix.scripts('resources/assets/themes/js/device.min.js', 'public/themes/js/device.min.js');
mix.scripts('resources/assets/themes/js/theme-org.js', 'public/themes/js/theme.min.js');




//footer
mix.scripts('resources/assets/includes/contact-form-7/js/scripts.js', 'public/includes/contact-form-7/js/scripts.js');
mix.scripts('resources/assets/plugins/js-cookie/js.cookie.min.js', 'public/plugins/js-cookie/js.cookie.min.js');
mix.scripts('resources/assets/plugins/frontend/avdesign.js', 'public/plugins/frontend/avdesign.min.js');
mix.scripts('resources/assets/plugins/cart/js/cart-fragments.min.js', 'public/plugins/cart/js/cart-fragments.min.js');
mix.scripts('resources/assets/plugins/yith-wishlist/js/jquery.selectBox.min.js', 'public/plugins/yith-wishlist/js/jquery.selectBox.min.js');
mix.scripts('resources/assets/plugins/yith-wishlist/js/jquery.yith-wcwl.js', 'public/plugins/yith-wishlist/js/jquery.yith-wcwl.js');
mix.scripts('resources/assets/plugins/isotope/isotope.pkgd.min.js', 'public/plugins/isotope/isotope.pkgd.min.js');
mix.scripts('resources/assets/plugins/waypoints/waypoints.min.js', 'public/plugins/waypoints/waypoints.min.js');
mix.scripts('resources/assets/plugins/js_composer/js/js_composer_front.min.js', 'public/plugins/js_composer/js/js_composer_front.min.js');

/*
mix.scripts('resources/assets/plugins/js_composer/js/dist/frontend-editor.min.js', 'public/plugins/js_composer/js/dist/frontend-editor.min.js');
mix.scripts('resources/assets/plugins/js_composer/js/frontend_editor/shortcodes/tta/tta_events.js', 'public/plugins/js_composer/js/frontend_editor/shortcodes/tta/tta_events.min.js');
mix.scripts('resources/assets/plugins/js_composer/js/frontend_editor/shortcodes/tta/vc_tta_accordion.js', 'public/plugins/js_composer/js/frontend_editor/shortcodes/tta/vc_tta_accordion.min.js');
mix.scripts('resources/assets/plugins/js_composer/js/frontend_editor/shortcodes/tta/vc_tta_pageable.js', 'public/plugins/js_composer/js/frontend_editor/shortcodes/tta/vc_tta_pageable.min.js');
mix.scripts('resources/assets/plugins/js_composer/js/frontend_editor/shortcodes/tta/vc_tta_section.js', 'public/plugins/js_composer/js/frontend_editor/shortcodes/tta/vc_tta_section.min.js');
mix.scripts('resources/assets/plugins/js_composer/js/frontend_editor/shortcodes/tta/vc_tta_tabs.js', 'public/plugins/js_composer/js/frontend_editor/shortcodes/tta/vc_tta_tabs.min.js');
mix.scripts('resources/assets/plugins/js_composer/js/frontend_editor/shortcodes/tta/vc_tta_tour.js', 'public/plugins/js_composer/js/frontend_editor/shortcodes/tta/vc_tta_tour.min.js');
*/




mix.scripts('resources/assets/includes/underscore/js/underscore.min.js', 'public/includes/underscore/js/underscore.min.js');
mix.scripts('resources/assets/includes/util/avd-util.min.js', 'public/includes/util/avd-util.min.js');
mix.scripts('resources/assets/plugins/cart/js/add-to-cart-variation.js', 'public/plugins/cart/js/add-to-cart-variation.min.js');

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


