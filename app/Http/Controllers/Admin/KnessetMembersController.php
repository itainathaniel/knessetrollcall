<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\KnessetMember;
use App\Party;
use Illuminate\Http\Request;

class KnessetMembersController extends Controller
{
    public function index(Request $request)
    {
        if (($request->input('party_id')) !== null) {
            $users = KnessetMember::wherePartyId($request->input('party_id'))->orderByName()->get();
        } elseif (($request->input('active')) !== null) {
            $users = KnessetMember::whereActive($request->input('active'))->orderByName()->get();
        } elseif (($request->input('isInside')) !== null) {
            $users = KnessetMember::where('isInside', $request->input('isInside'))->orderByName()->get();
        } elseif (($request->input('party_is_coalition')) !== null) {
            $users = KnessetMember::whereIn('party_id', function ($query) {
                $query->select('id')->from('parties')->whereIsCoalition(true);
            })->orderByName()->get();
        } else {
            $users = KnessetMember::orderByName()->get();
        }

        return view('admin.knessetmembers.index', compact('users'));
    }

    public function edit(KnessetMember $knessetmember)
    {
        $parties = Party::all();

        return view('admin.knessetmembers.edit', compact('knessetmember', 'parties'));
    }

    public function update(Request $request, KnessetMember $knessetMember)
    {
        $this->validate($request, [
            'knesset_id'    => 'required',
            'party_id'      => 'required',
            'name'          => 'required',
            'image'         => 'required',
            'isInside'      => 'required|boolean',
            'active'        => 'required|boolean',
        ]);

        $knessetMember->update($request->all());

        return redirect()->back();
    }
}
