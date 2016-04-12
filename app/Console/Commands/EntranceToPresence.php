<?php

namespace App\Console\Commands;

use App\EntranceLog;
use App\Presence;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EntranceToPresence extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'krc:presence';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Browsing the entrance logs and makes presents rows.';

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
        $entrance_logs = EntranceLog::whereProcessed(false)->where('isInside', '=', false)->limit(20)->get();

        if (count($entrance_logs) == 0) {
            $this->comment('No entrance logs');

            return;
        }

        foreach ($entrance_logs as $log) {
            $temp = EntranceLog::whereKnessetmembersId($log['knessetmembers_id'])->where('isInside', '=', true)->where('id', '<', $log['id'])->orderBy('id', 'desc')->firstOrFail();

            $work = 0;

            try {
                $presence = Presence::whereKnessetmemberId($log['knessetmembers_id'])
                    ->where('day', $temp['created_at']->toDateString())
                    ->firstOrFail();

                $work = $presence->work;
            } catch (ModelNotFoundException $e) {
                $presence = new Presence();
                $presence->knessetmember_id = $log['knessetmembers_id'];
                $presence->day = $temp['created_at']->toDateString();
            }

            $presence->party_id = $presence->knessetmember->party_id;
            $presence->is_coalition = $presence->knessetmember->party->is_coalition;
            $presence->week_day = $temp['created_at']->format('w');
            $presence->work = $work + $temp['created_at']->diffInMinutes($log['created_at']);

            $presence->save();

            $temp->processed();
            $log->processed();

            $this->info('KM '.$log['knessetmembers_id'].' worked '.round($presence->work / 60, 2).' hours on '.$log['created_at'].' - '.$temp['created_at']);
        }
    }
}
