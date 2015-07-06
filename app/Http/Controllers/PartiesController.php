<?php namespace KnessetRollCall\Http\Controllers;

use KnessetRollCall\Http\Requests;
use KnessetRollCall\Http\Requests\PageRequest;
use KnessetRollCall\Http\Controllers\Controller;
use KnessetRollCall\KnessetMember;
use KnessetRollCall\Party;

class PartiesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $members = KnessetMember::active()->orderBy('party_id', 'asc')->orderByInside()->get();

        return view('parties.index', compact('members'));
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Party $party)
	{
		$knessetMembers = KnessetMember::wherePartyId($party->id)->orderByInside()->get();

        $today = $party->presence_today();
        $week = $party->presence_week();
        $month = $party->presence_month();

        return view('parties.show', compact('party', 'knessetMembers', 'today', 'week', 'month'));
	}

}
