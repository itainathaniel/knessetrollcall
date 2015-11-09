<?php

namespace KnessetRollCall\Http\Controllers\Admin;

use Illuminate\Http\Request;
use KnessetRollCall\Http\Controllers\Controller;
use KnessetRollCall\Party;

class PartiesController extends Controller
{
    public function index(Request $request)
    {
        if (($request->input('is_coalition')) !== null) {
            $parties = Party::whereIsCoalition($request->input('is_coalition'))->get();
        } else {
            $parties = Party::all();
        }

        return view('admin.parties.index', compact('parties'));
    }

    public function show(Party $party)
    {
        dd(['one', $party]);
    }

    public function edit(Party $party)
    {
        return view('admin.parties.edit', compact('party'));
    }

    public function update(Request $request, Party $party)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $party->update($request->all());

        return redirect()->back();
    }
}
