<?php

namespace KnessetRollCall\Listeners;

use Illuminate\Support\Facades\Artisan;
use KnessetRollCall\Events\newKnessetMember;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use KnessetRollCall\KnessetMember;

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
     * @param  newKnessetMember  $event
     * @return void
     */
    public function handle(newKnessetMember $event)
    {
        Artisan::call('krc:parties');

        $knessetMember = KnessetMember::find($event->KnessetMember->id);

        Mail::send('emails.new-member', ['knessetMember' => $knessetMember], function($message){
            $message->to('itainathaniel@gmail.com')->subject(Lang::get('emails.new-member.subject'));
        });
    }
}
