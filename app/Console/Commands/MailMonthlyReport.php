<?php

namespace App\Console\Commands;

use App\Http\Controllers\ReportsController;
use DateTime;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;

class MailMonthlyReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'krc:mail:monthly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email month report to me.';

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
        $start = new DateTime('first day of last month');
        $end = new DateTime('last day of last month');

        $report = new ReportsController($start->getTimestamp(), $end->getTimestamp());
        $report->setView('emails.monthly');

        Mail::send('emails.raw', ['content' => $report->emailContent()], function ($message) {
            $message->to('itainathaniel@gmail.com')->subject(Lang::get('emails.monthly-report.subject'));
        });
    }
}
