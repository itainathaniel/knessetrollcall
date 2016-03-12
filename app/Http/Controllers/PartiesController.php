<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\PageRequest;
use App\Http\Controllers\Controller;
use App\KnessetMember;
use App\Party;

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
