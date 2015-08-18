<?php

namespace KnessetRollCall\Http\Controllers\Admin;

use Illuminate\Http\Request;

use KnessetRollCall\Http\Requests;
use KnessetRollCall\Http\Controllers\Controller;
use KnessetRollCall\Party;
use KnessetRollCall\Http\Requests\UpdateParty;

class PartiesController extends Controller
{

    public function index()
    {
        $parties = Party::all();

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

    public function update(UpdateParty $request)
    {
        dd($request->all());
    }

}
