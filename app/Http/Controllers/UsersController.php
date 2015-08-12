<?php

namespace KnessetRollCall\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use KnessetRollCall\Http\Requests;
use KnessetRollCall\Http\Controllers\Controller;
use KnessetRollCall\User;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

//        $this->middleware('admin', ['only' => 'show']);
    }

    public function show($user)
    {
//        $user = User::find(Auth::user()->id)->firstOrFail();

        return view('users.show', compact('user'));
    }

    public function edit()
    {
        $user = User::find(Auth::user()->id)->firstOrFail();

        return view('users.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,id,' . Auth::user()->id,
            'password' => 'required_with:password_confirmation',
            'password_confirmation' => 'required_with:password|same:password',
        ]);

        $user = User::find(Auth::user()->id)->first();
        $user->update($request->all());

        $save = false;
        if ($request->input('mail_daily') == null) {
            $user->mail_daily = false;
            $save = true;
        }
        if ($request->input('mail_weekly') == null) {
            $user->mail_weekly = false;
            $save = true;
        }
        if ($request->input('mail_monthly') == null) {
            $user->mail_monthly = false;
            $save = true;
        }

        if (!empty($request->input('password'))) {
            $user->password = Hash::make($request->input('password'));
            $save = true;
        }

        if ($save) {
            $user->save();
        }

        return redirect()->back();
    }

}
