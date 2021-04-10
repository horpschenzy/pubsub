<?php

namespace App\Listeners;

use App\Events\Publish;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PublishToSubscriber
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
     * @param  Publish  $event
     * @return void
     */
    public function handle(Publish $event)
    {
        var_dump('YAY');
    }
}
