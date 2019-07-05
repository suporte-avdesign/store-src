<?php

namespace AVD\Providers;

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
            'ConfigProduct',
            'ConfigSite',
            'ImageColor',
            'GridProduct',
            'Product',
            'Section',
            'State',
            'SocialShare'
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
        //
    }
}
