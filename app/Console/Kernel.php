<?php

namespace App\Console;

use App\Console\Commands\EntranceToPresence;
use App\Console\Commands\GrabImage;
use App\Console\Commands\GrabParties;
use App\Console\Commands\LogEntries;
use App\Console\Commands\MailCustomReport;
use App\Console\Commands\MailDailyReport;
use App\Console\Commands\MailMonthlyReport;
use App\Console\Commands\MailWeeklyReport;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        LogEntries::class,
        GrabParties::class,
        GrabImage::class,
        EntranceToPresence::class,
        MailDailyReport::class,
        MailWeeklyReport::class,
        MailMonthlyReport::class,
        MailCustomReport::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('krc:log')->everyHour();
        $schedule->command('krc:presence')->everyTenMinutes();
        $schedule->command('krc:mail:daily')->dailyAt('7:00');
        $schedule->command('krc:mail:weekly')->weekly()->sundays()->at('7:00');
        $schedule->command('krc:mail:monthly')->monthly()->at('7:00');
        $schedule->command('db:backup --database=mysql --compression=null --destination=dropbox --destinationPath=`date +\%Y-%m-%d`-production.sql')->dailyAt('16:15');
    }
}
