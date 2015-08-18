<?php

namespace KnessetRollCall\Http\Controllers\Admin;

use Illuminate\Http\Request;

use KnessetRollCall\Http\Requests;
use KnessetRollCall\Http\Controllers\Controller;
use KnessetRollCall\User;

class AdminController extends Controller
{

    public function index()
    {
        $users = User::latest()->limit(10)->get();

        return view('admin.admin.dashboard', compact('users'));
    }

}
