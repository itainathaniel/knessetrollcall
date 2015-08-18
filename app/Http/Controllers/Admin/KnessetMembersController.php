<?php

namespace KnessetRollCall\Http\Controllers\Admin;

use Illuminate\Http\Request;

use KnessetRollCall\Http\Requests;
use KnessetRollCall\Http\Controllers\Controller;
use KnessetRollCall\KnessetMember;

class KnessetMembersController extends Controller
{

    public function index()
    {
        $users = KnessetMember::all();

        return view('admin.knessetmembers.index', compact('users'));
    }

}
