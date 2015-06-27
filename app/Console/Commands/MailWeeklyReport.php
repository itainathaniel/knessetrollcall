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

class MailWeeklyReport extends Command
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
        $dates = [
            date('Y-m-d', strtotime('last sunday', strtotime('last sunday', time()))),
            date('Y-m-d', strtotime('last saturday', strtotime('last sunday', time())))
        ];
        $dates_title = $dates[0] . ' - ' . $dates[1];

        $present = Presence::select('knessetmember_id', DB::raw('sum(work) as minutes'))->whereIn('knessetmember_id', function($query){
            $query->from('knessetmembers')->where('active', '=', true)->lists('id');
        })
            ->whereBetween('day', $dates)
            ->groupBy('knessetmember_id')
            ->orderBy('minutes', 'desc')
            ->get();

        $ids = [];
        foreach ($present as $km) {
            $ids[] = $km->knessetmember_id;
        }
        $absent = KnessetMember::whereNotIn('id', $ids)->where('active', '=', true)->get();

        $html = view('emails.weekly', compact('dates_title', 'absent', 'present'))->render();
        $css = file_get_contents(public_path() . '/css/all.css');
        $report_path = '/static/emails/weekly-' . date('Y-m-d') . '.html';

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
            $message->to('itainathaniel@gmail.com')->subject(Lang::get('emails.weekly-report.subject'));
        });
    }
}
