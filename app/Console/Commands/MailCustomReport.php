<?php

namespace App\Console\Commands;

use DateTime;
use App\Presence;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\ReportsController;

class MailCustomReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'krc:mail:custom
                            {--all : Report all the dates}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email custom report to me.';

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
        if ($this->option('all') != 1) {
            $start = new DateTime($this->ask('What is the start date string?'));
            $end = new DateTime($this->ask('What is the end date string?'));
        } else {
            $start = new DateTime('may 2015');
            $end = new DateTime('tomorrow');
        }

        $report = new ReportsController($start->getTimestamp(), $end->getTimestamp());
        $report->setView('emails.custom');

        Mail::send('emails.raw', ['content' => $report->emailContent()], function($message) {
            $message->to('itainathaniel@gmail.com')->subject(Lang::get('emails.custom-report.subject'));
        });
    }
}
