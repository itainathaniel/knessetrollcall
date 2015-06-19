<?php namespace KnessetRollCall\Http\Controllers;

use KnessetRollCall\EntranceLog;
use KnessetRollCall\Http\Requests;
use KnessetRollCall\Http\Requests\PageRequest;
use KnessetRollCall\Http\Controllers\Controller;
use KnessetRollCall\KnessetMember;

class KnessetMembersController extends Controller {

    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$members = KnessetMember::all();

        return view('knessetmembers.index', compact('members'));
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $knessetMember = KnessetMember::whereId($id)->firstOrFail();

        $sameParty = KnessetMember::wherePartyId($knessetMember->party_id)->whereNotIn('id', array($knessetMember->id))->get();

        $today = $knessetMember->presence_today();
        $week = $knessetMember->presence_week();
        $month = $knessetMember->presence_month();

        $now = EntranceLog::whereKnessetmembersId($id)->where('isInside', '=', true)->orderBy('created_at', 'desc')->limit(1)->get();

        return view('knessetmembers.show', compact('knessetMember', 'entranceLogs', 'sameParty', 'today', 'week', 'month'));
	}

    public function showJson($id)
    {
        $entranceLogs = EntranceLog::whereKnessetmembersId($id)->orderBy('created_at', 'asc')->get();

        return $entranceLogs;
    }

    public function log($id)
    {
        $knessetMember = KnessetMember::whereId($id)->firstOrFail();

        $entranceLogs = EntranceLog::whereKnessetmembersId($id)->orderBy('created_at', 'asc')->get();

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
