<?php

namespace KnessetRollCall\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use KnessetRollCall\Console\Commands\EntranceToPresence;
use KnessetRollCall\Console\Commands\GrabImage;
use KnessetRollCall\Console\Commands\GrabParties;
use KnessetRollCall\Console\Commands\LogEntries;
use KnessetRollCall\Console\Commands\MailCustomReport;
use KnessetRollCall\Console\Commands\MailDailyReport;
use KnessetRollCall\Console\Commands\MailMonthlyReport;
use KnessetRollCall\Console\Commands\MailWeeklyReport;

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
        $schedule->command('krc:log')->everyFiveMinutes();
        $schedule->command('krc:presence')->everyTenMinutes();
        $schedule->command('krc:mail:daily')->dailyAt('7:00');
        $schedule->command('krc:mail:weekly')->weekly()->sundays()->at('7:00');
        $schedule->command('krc:mail:monthly')->monthly()->at('7:00');
        $schedule->command('db:backup --database=mysql --compression=null --destination=dropbox --destinationPath=`date +\%Y-%m-%d`-production.sql')->dailyAt('16:15');
    }
}
