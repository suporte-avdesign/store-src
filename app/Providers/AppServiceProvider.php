<?php

namespace AVD\Providers;

use AVD\Models\Web\User;
use AVD\Observers\UserObserver;
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

        $models = array(
            'AccountType',
            'Cart',
            'Category',
            'ConfigKeyword',
            'ConfigImages',
            'ConfigColorPosition',
            'ConfigFormPayment',
            'ConfigFreight',
            'ConfigProduct',
            'ConfigProfileClient',
            'ConfigShipping',
            'ConfigSite',
            'Contact',
            'ContentTermsConditions',
            'ImageColor',
            'GridProduct',
            'Order',
            'PagSeguro',
            'Product',
            'Section',
            'State',
            'SocialShare',
            'User',
            'UserAddress',
            'UserNote'
        );

        foreach ($models as $model) {
            $this->app->bind("AVD\Interfaces\Web\\{$model}Interface", "AVD\Repositories\Web\\{$model}Repository");
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
