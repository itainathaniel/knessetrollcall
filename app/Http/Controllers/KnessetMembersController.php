<?php namespace KnessetRollCall\Http\Controllers;

use Carbon\Carbon;
use KnessetRollCall\EntranceLog;
use KnessetRollCall\Http\Requests;
use KnessetRollCall\Http\Requests\PageRequest;
use KnessetRollCall\Http\Controllers\Controller;
use KnessetRollCall\KnessetMember;

class KnessetMembersController extends Controller {

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(KnessetMember $knessetMember)
	{
        $sameParty = KnessetMember::wherePartyId($knessetMember->party_id)->whereNotIn('id', array($knessetMember->id))->orderByInside()->get();

        $lastEntranceSign = 0;
        $lastEntrance = EntranceLog::whereKnessetmembersId($knessetMember->id)->where('isInside', '=', true)->orderBy('id', 'desc')->take(1)->first();
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
        $knessetMember = KnessetMember::whereId($knessetMember->id)->firstOrFail();

        $entranceLogs = EntranceLog::whereKnessetmembersId($knessetMember->id)->latest()->get();

        return view('knessetmembers.log', compact('knessetMember', 'entranceLogs'));
    }

    public function inside()
    {
        $members = KnessetMember::where('isInside', '=', true)->get();

        return view('knessetmembers.inside', compact('members'));
    }

    public function outside()
    {
        $members = KnessetMember::where('isInside', '=', false)->where('party_id', '!=', 0)->get();

        return view('knessetmembers.outside', compact('members'));
    }


}
