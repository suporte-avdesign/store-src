<?php

namespace AVD\Providers;

//use AVD\Models\Web\User;
//use AVD\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (env('APP_ENV') === 'production') {
            $this->app['request']->server->set('HTTPS', true);
        }

        /**
         * Models
         */
        $models = array(
            'AccountType',
            'Cart',
            'Category',
            'ConfigBanner',
            'ConfigColorPosition',
            'ConfigFormPayment',
            'ConfigFreight',
            'ConfigKeyword',
            'ConfigImages',
            'ConfigProduct',
            'ConfigProfileClient',
            'ConfigShipping',
            'ConfigSite',
            'ConfigSlider',
            'ConfigSubjectContact',
            'Contact',
            'ContentContract',
            'ContentFaq',
            'ContentFormPayment',
            'ContentDelivery',
            'ContentDeliveryReturn',
            'ContentPrivacyPolicy',
            'ContentTermsConditions',
            'ImageBanner',
            'ImageColor',
            'ImageSlider',
            'GridProduct',
            'Newsletter',
            'Order',
            'OrderItem',
            'OrderNote',
            'OrderShipping',
            'PaymentBillet',
            'PaymentCard',
            'PaymentCash',
            'PaymentCompany',
            'Product',
            'Section',
            'State',
            'SocialShare',
            'User',
            'UserAddress',
            'UserNote',
            'UserTransport'
        );

        foreach ($models as $model) {
            $this->app->bind("AVD\Interfaces\Web\\{$model}Interface", "AVD\Repositories\Web\\{$model}Repository");
        }

        /**
         * Services
         */
        $services = array(
            'PagSeguro'
        );

        foreach ($services as $service) {
            $this->app->bind("AVD\Services\Web\\{$service}ServicesInterface", "AVD\Services\Web\\{$service}Services");
        }





    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
