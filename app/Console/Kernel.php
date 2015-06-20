<?php

namespace KnessetRollCall\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use KnessetRollCall\Console\Commands\LogEntries;
use KnessetRollCall\Console\Commands\GrabParties;
use KnessetRollCall\Console\Commands\GrabImage;
use KnessetRollCall\Console\Commands\EntranceToPresence;
use KnessetRollCall\Console\Commands\MailDailyReport;
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
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('krc:log')->everyFiveMinutes();
        $schedule->command('krc:presence')->hourly();
        $schedule->command('krc:mail:daily')->dailyAt('7:00');
        $schedule->command('krc:mail:weekly')->weekly()->sundays()->at('7:00');
    }
}
