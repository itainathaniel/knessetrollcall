<?php

namespace App\Http\Controllers;

use App\EntranceLog;
use App\KnessetMember;
use App\Party;
use DateTime;
use Illuminate\Support\Facades\Cache;

class KnessetMembersController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show(KnessetMember $knessetMember)
    {
        $sameParty = KnessetMember::wherePartyId($knessetMember->party_id)->whereNotIn('id', [$knessetMember->id])->orderByInside()->get();

        $lastEntranceSign = 0;
        $lastEntrance = EntranceLog::whereKnessetmembersId($knessetMember->id)->where('isInside', '=', true)->where('processed', '=', false)->orderBy('id', 'desc')->take(1)->first();
        if ($lastEntrance) {
            $lastEntranceSign = $lastEntrance->created_at->diffInMinutes();
        }

        $today = $knessetMember->presence_today() + $lastEntranceSign;
        $week = $knessetMember->presence_week() + $lastEntranceSign;
        $month = $knessetMember->presence_month() + $lastEntranceSign;

        EntranceLog::where('knessetmembers_id', '=', $knessetMember->id)->where('isInside', '=', true)->orderBy('created_at', 'desc')->limit(1)->get();

        return view('knessetmembers.show', compact('knessetMember', 'entranceLogs', 'sameParty', 'today', 'week', 'month', 'lastEntranceSign'));
    }

    public function showJson(KnessetMember $knessetMember)
    {
        $entranceLogs = EntranceLog::whereKnessetmembersId($knessetMember->id)->orderBy('created_at', 'asc')->get();

        return $entranceLogs;
    }

    public function log(KnessetMember $knessetMember)
    {
        $entranceLogs = EntranceLog::whereKnessetmembersId($knessetMember->id)->latest()->get();

        return view('knessetmembers.log', compact('knessetMember', 'entranceLogs'));
    }

    public function inside()
    {
        $members = KnessetMember::inside()->get();

        return view('knessetmembers.inside', compact('members'));
    }

    public function outside()
    {
        $members = KnessetMember::outside()->where('party_id', '!=', 0)->get();

        return view('knessetmembers.outside', compact('members'));
    }

    public function allTimeTable()
    {
        if (Cache::has('leaderboard_all_time')) {
            $members = Cache::get('leaderboard_all_time');
        } else {
            $start = new DateTime('june 1st, 2015');
            $end = new DateTime('today');

            $report = new ReportsController($start->getTimestamp(), $end->getTimestamp());
            $members = $report->present;

            Cache::put('leaderboard_all_time', $members, 15);
        }

        return view('knessetmembers.table')->withMembers($members);
    }

    public function fullscreen()
    {
        $members = KnessetMember::active()->where('party_id', '!=', 0)->orderBy('name')->get();
        $parties = Party::all();

        return view('knessetmembers.fullscreen')->withMembers($members)->withParties($parties);
    }
}
