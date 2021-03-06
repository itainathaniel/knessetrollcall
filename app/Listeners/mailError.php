<?php

namespace App\Listeners;

use App\Events\errorFetchingLogEntries;
use Illuminate\Support\Facades\Mail;

class mailError
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
     * @param errorFetchingLogEntries $event
     *
     * @return void
     */
    public function handle(errorFetchingLogEntries $event)
    {
        Mail::send('emails.raw', ['content' => $event->error], function ($message) {
            $message->to('itainathaniel@gmail.com')->subject('KnessetRollCall Error!!!');
        });
    }
}
