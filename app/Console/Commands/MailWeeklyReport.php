<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\ReportsController;

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
        $start_time = strtotime('last sunday', strtotime('last saturday'));
        $end_time = strtotime('last saturday');

        $report = new ReportsController($start_time, $end_time);
        $report->setView('emails.weekly');

        Mail::send('emails.raw', ['content' => $report->emailContent()], function($message) {
            $message->to('itainathaniel@gmail.com')->subject(Lang::get('emails.weekly-report.subject'));
        });
    }
}
