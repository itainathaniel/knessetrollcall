<?php

namespace KnessetRollCall\Http\Controllers\Admin;

use Illuminate\Http\Request;

use KnessetRollCall\Http\Requests;
use KnessetRollCall\Http\Controllers\Controller;
use KnessetRollCall\KnessetMember;
use KnessetRollCall\Party;

class KnessetMembersController extends Controller
{

    public function index(Request $request)
    {
        if (($request->input('party_id')) !== null) {
            $users = KnessetMember::wherepartyId($request->input('party_id'))->get();
        } else {
            $users = KnessetMember::all();
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
            'knesset_id' => 'required',
            'party_id' => 'required',
            'name' => 'required',
            'image' => 'required',
            'isInside' => 'required|boolean',
            'active' => 'required|boolean',
        ]);

        $knessetMember->update($request->all());

        return redirect()->back();
    }

}
