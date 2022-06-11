<?php

namespace App\Listeners;

use App\Events\NewDoubtMessageEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewDoubtMessageListener
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
     * @param  \App\Events\NewDoubtMessageEvent  $event
     * @return void
     */
    public function handle(NewDoubtMessageEvent $event)
    {
        //
    }
}
