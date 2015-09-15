<?php

namespace KnessetRollCall\Http\Controllers\Admin;

use KnessetRollCall\User;
use KnessetRollCall\Http\Requests;
use Illuminate\Support\Facades\Auth;
use KnessetRollCall\Http\Requests\UpdateUser;
use KnessetRollCall\Http\Controllers\Controller;

class UsersController extends Controller
{

    public function index()
    {
        $users = User::all();

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
