<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\SolicitudAmistadAceptadaEvent;
use App\Notifications\SolicitudAmistadAceptada;

class SolicitudAmistadAceptadaListener
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
     * @param  \App\Events\SolicitudAmistadAceptadaEvent  $event
     * @return void
     */
    public function handle(SolicitudAmistadAceptadaEvent $event)
    {
        $event->user->notify(new SolicitudAmistadAceptada(auth()->user()));
    }
}
