<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        if (($request->input('admin')) !== null) {
            $users = User::whereAdmin(true)->get();
        } elseif (($request->input('verified')) !== null) {
            $users = User::whereVerified(false)->get();
        } elseif (($request->input('mail_daily')) !== null) {
            $users = User::whereMailDaily(true)->get();
        } elseif (($request->input('mail_weekly')) !== null) {
            $users = User::whereMailWeekly(true)->get();
        } elseif (($request->input('mail_monthly')) !== null) {
            $users = User::whereMailMonthly(true)->get();
        } else {
            $users = User::all();
        }

        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(UpdateUser $request)
    {
        $user = User::find(Auth::user()->id)->firstOrFail();
        $user->updateSettings($request);

        return redirect()->back();
    }
}
