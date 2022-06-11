<?php

namespace App\Listeners;

use App\Events\AlguienHaPublicadoEvent;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\AlguienHaPublicado;
use Illuminate\Contracts\Queue\ShouldQueue;

class AlguienHaPublicadoListener
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
     * @param  \App\Events\AlguienHaPublicadoEvent  $event
     * @return void
     */
    public function handle(AlguienHaPublicadoEvent $event)
    {
        $event->user->notify(new AlguienHaPublicado(auth()->user()));
    }
}
