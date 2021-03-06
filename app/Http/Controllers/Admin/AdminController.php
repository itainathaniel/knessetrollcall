<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\KnessetMember;
use App\Party;
use App\User;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::latest()->limit(10)->get();

        $total_users = User::count();
        $total_users_admins = User::whereAdmin(true)->count();
        $total_knessetmembers = KnessetMember::count();
        $total_knessetmembers_inactive = KnessetMember::whereActive(false)->count();
        $total_parties = Party::count();
        $total_parties_coalition = Party::whereIsCoalition(true)->count();

        return view('admin.admin.dashboard', compact(
            'users',
            'total_users', 'total_users_admins',
            'total_knessetmembers', 'total_knessetmembers_inactive',
            'total_parties', 'total_parties_coalition'
        ));
    }
}
