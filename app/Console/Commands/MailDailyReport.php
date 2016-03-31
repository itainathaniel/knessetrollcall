<?php

namespace App\Console\Commands;

use App\Http\Controllers\ReportsController;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;

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

        $users = (new User())->dailyRecipients();
        foreach ($users as $user) {
            Mail::send('emails.raw', ['content' => $report->emailContent()], function ($message) use ($user) {
                $message->to($user->email)->subject(Lang::get('emails.daily-report.subject'));
            });
        }
    }
}
