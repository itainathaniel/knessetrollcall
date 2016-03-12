<?php

namespace App\Listeners;

use App\Events\newKnessetMember;
use App\KnessetMember;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;

class mailAdmin
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
     * @param newKnessetMember $event
     *
     * @return void
     */
    public function handle(newKnessetMember $event)
    {
        Artisan::call('krc:parties');

        $knessetMember = KnessetMember::find($event->KnessetMember->id);

        Mail::send('emails.new-member', ['knessetMember' => $knessetMember], function ($message) {
            $message->to('itainathaniel@gmail.com')->subject(Lang::get('emails.new-member.subject'));
        });
    }
}
