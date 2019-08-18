<?php

namespace AVD\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'AVD\Events\UserRegisteredEvent' => [
            'AVD\Listeners\UserRegisteredSendMailListener',
        ],
        'AVD\Events\UserRegisteredNewsletterEvent' => [
            'AVD\Listeners\UserRegisteredNewsletterListener',
        ],
        'AVD\Events\UserRegisteredNoteEvent' => [
            'AVD\Listeners\UserRegisteredNoteListener',
        ],

        'AVD\Events\UserRegisterConfirmedEvent' => [
            'AVD\Listeners\UserRegisterConfirmedListener',
        ],

        'AVD\Events\UserRegisteredCheckoutEvent' => [
            'AVD\Listeners\UserRegisteredCheckoutSendMailListener',
        ]


    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
