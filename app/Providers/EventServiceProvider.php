<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        \App\Events\AlguienHaPublicadoEvent::class => [
            \App\Listeners\AlguienHaPublicadoListener::class,
        ],
        \App\Events\SolicitudAmistadRecibidaEvent::class => [
            \App\Listeners\SolicitudAmistadRecibidaListener::class,
        ],
        \App\Events\SolicitudAmistadAceptadaEvent::class => [
            \App\Listeners\SolicitudAmistadAceptadaListener::class,
        ],
        \App\Events\NewDoubtMessageEvent::class => [
            \App\Listeners\NewDoubtMessageListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
