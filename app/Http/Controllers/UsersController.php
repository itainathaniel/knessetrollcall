<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUser;
use App\User;
use Illuminate\Support\Facades\Auth;

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
        return view('users.edit', ['user' => Auth::user()]);
    }

    public function update(UpdateUser $request)
    {
        Auth::user()->updateSettings($request);

        return redirect()->back();
    }
}
