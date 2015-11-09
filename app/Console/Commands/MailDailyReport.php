<?php

namespace KnessetRollCall\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use KnessetRollCall\Http\Controllers\ReportsController;

class MailDailyReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'krc:mail:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email day report to me.';

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
        $start_time = $end_time = strtotime('yesterday');

        $report = new ReportsController($start_time, $end_time);
        $report->setView('emails.daily');

        Mail::send('emails.raw', ['content' => $report->emailContent()], function ($message) {
            $message->to('itainathaniel@gmail.com')->subject(Lang::get('emails.daily-report.subject'));
        });
    }
}
