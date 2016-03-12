<?php

namespace App\Http\Controllers;

use App\KnessetMember;
use App\Presence;
use Illuminate\Support\Facades\DB;
use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;

class ReportsController extends Controller
{
    protected $start_date;

    protected $end_date;

    protected $title;

    public $present;

    protected $absent;

    protected $minutes;

    protected $parties;

    protected $minutesPerKM;

    protected $view = 'emails.daily';

    protected $css_path = '/css/all.css';

    protected $html;

    public function __construct($start_time, $end_time)
    {
        $this->setDates($start_time, $end_time);
        $this->setTitle();
        $this->setPresent();
        $this->setAbsent();
    }

    public function setView($view)
    {
        $this->view = $view;
    }

    public function emailContent()
    {
        $this->setHTML(
            $this->title,
            $this->present,
            $this->absent,
            $this->minutes,
            $this->parties,
            $this->minutesPerKM
        );

        $css = file_get_contents(public_path().$this->css_path);

        $converter = new CssToInlineStyles();
        $converter->setHTML($this->html);
        $converter->setCSS($css);
        $converter->setUseInlineStylesBlock();
        $converter->setCleanup();
        $converter->setStripOriginalStyleTags();
        $content = $converter->convert();

        return $content;
    }

    /**
     * @param $start_time
     * @param $end_time
     */
    private function setDates($start_time, $end_time)
    {
        $this->start_date = date('Y-m-d', $start_time);
        $this->end_date = date('Y-m-d', $end_time);
    }

    /**
     * Set the output title for the report.
     */
    private function setTitle()
    {
        $this->title = $this->start_date;

        if ($this->start_date != $this->end_date) {
            $this->title .= ' - '.$this->end_date;
        }
    }

    /**
     * @return mixed
     */
    private function setPresent()
    {
        $knessetmemberids = KnessetMember::active()->pluck('id');
        $this->present = Presence::select('knessetmember_id', DB::raw('sum(work) as minutes'))
            ->whereIn('knessetmember_id', $knessetmemberids)
            ->whereBetween('day', [$this->start_date, $this->end_date])
            ->groupBy('knessetmember_id')
            ->orderBy('minutes', 'desc')
            ->get();
    }

    /**
     * @return array
     */
    private function setAbsent()
    {
        $ids = [];
        $this->minutes = 0;
        $this->parties = [];
        foreach ($this->present as $km) {
            $ids[] = $km->knessetmember_id;
            $this->minutes += $km->minutes;

            if (!isset($this->parties[$km->knessetmember->party->id])) {
                $this->parties[$km->knessetmember->party->id] = ['name' => $km->knessetmember->party->name, 'members' => 0, 'minutes' => 0];
            }
            $this->parties[$km->knessetmember->party->id]['members']++;
            $this->parties[$km->knessetmember->party->id]['minutes'] += $km->minutes;
        }
        $this->absent = KnessetMember::whereNotIn('id', $ids)->where('active', '=', true)->get();

        $this->minutesPerKM = count($this->present) == 0 ? 0 : round($this->minutes / count($this->present));
    }

    /**
     * @param $dates_title
     * @param $present
     * @param $absent
     * @param $minutes
     * @param $parties
     * @param $minutesPerKM
     *
     * @return string
     */
    private function setHTML($dates_title, $present, $absent, $minutes, $parties, $minutesPerKM)
    {
        $this->html = view($this->view, compact('dates_title', 'present', 'absent', 'minutes', 'parties', 'minutesPerKM'))->render();
    }
}
