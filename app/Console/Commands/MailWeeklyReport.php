<?php

namespace KnessetRollCall\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use KnessetRollCall\KnessetMember;

class MailWeeklyReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'krc:mail:weekly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email weekly report to me.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $report_title = 'דו״ח שבועי';
        $members = KnessetMember::active()->get();

        Mail::send('emails.weekly', compact('members', 'report_title'), function($message){
            $message->to('itainathaniel@gmail.com')->subject('Weekly Update!');
        });
    }
}
