<?php

namespace KnessetRollCall\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use KnessetRollCall\KnessetMember;
use KnessetRollCall\Presence;
use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;

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
        $dates_title = date('Y-m-d', strtotime('yesterday'));

        $present = Presence::select('knessetmember_id', DB::raw('sum(work) as minutes'))->whereIn('knessetmember_id', function($query){
            $query->from('knessetmembers')->where('active', '=', true)->lists('id');
        })
            ->where('day', '=', $dates_title)
            ->groupBy('knessetmember_id')
            ->orderBy('minutes', 'desc')
            ->get();

        $ids = [];
        $minutes = 0;
        $parties = [];
        foreach ($present as $km) {
            $ids[] = $km->knessetmember_id;
            $minutes += $km->minutes;

            if (!isset($parties[$km->knessetmember->party->id])) {
                $parties[$km->knessetmember->party->id] = ['name' => $km->knessetmember->party->name, 'members' => 0, 'minutes' => 0];
            }
            $parties[$km->knessetmember->party->id]['members']++;
            $parties[$km->knessetmember->party->id]['minutes'] += $km->minutes;
        }
        $absent = KnessetMember::whereNotIn('id', $ids)->where('active', '=', true)->get();

        $minutesPerKM = count($present) == 0 ? 0 : round($minutes/count($present));

        $html = view('emails.daily', compact('dates_title', 'present', 'absent', 'minutes', 'parties', 'minutesPerKM'))->render();
        $css = file_get_contents(public_path() . '/css/all.css');
        $report_path = '/static/emails/daily-' . date('Y-m-d') . '.html';

        $converter = new CssToInlineStyles();
        $converter->setHTML($html);
        $converter->setCSS($css);
        $converter->setUseInlineStylesBlock();
        $converter->setCleanup();
        $converter->setStripOriginalStyleTags();
        $converter->setHTML($html);
        $content =  $converter->convert();

        // @TODO: maybe I'll delete older reports some day?
        Storage::disk('local')->put($report_path, $content);

        Mail::send('emails.raw', ['content' => $content], function($message){
            $message->to('itainathaniel@gmail.com')->subject(Lang::get('emails.daily-report.subject'));
        });
    }
}
