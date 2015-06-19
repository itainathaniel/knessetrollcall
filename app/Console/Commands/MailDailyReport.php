<?php

namespace KnessetRollCall\Console\Commands;

use Illuminate\Console\Command;

class MailDailyReport extends Command
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
        mail('itainathaniel@gmail.com', 'moo', 'miaoo');
    }
}
