<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\SolicitudAmistadRecibidaEvent;
use App\Notifications\SolicitudAmistadRecibida;

class SolicitudAmistadRecibidaListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\SolicitudAmistadRecibidaEvent  $event
     * @return void
     */
    public function handle(SolicitudAmistadRecibidaEvent $event)
    {
        $event->user->notify(new SolicitudAmistadRecibida(auth()->user()));
    }
}
