<?php

namespace KnessetRollCall\Http\Controllers;

use Illuminate\Http\Request;
use KnessetRollCall\Http\Requests\UpdateUser;

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

    public function show(User $user)
    {
        if ($user->id == null) {
            $user = User::find(Auth::user()->id)->firstOrFail();
        }

        return view('users.show', compact('user'));
    }

    public function edit()
    {
        $user = User::find(Auth::user()->id)->firstOrFail();

        return view('users.edit', compact('user'));
    }

    public function update(UpdateUser $request)
    {
        $user = User::find(Auth::user()->id)->firstOrFail();
        $user->updateSettings($request);

        return redirect()->back();
    }

}
