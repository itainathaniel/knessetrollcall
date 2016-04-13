<?php

namespace App\Http\Controllers;

use App\KnessetMember;

class PagesController extends Controller
{
    public function index()
    {
        $membersInside = KnessetMember::inside()->get();

        $membersLatestIn = KnessetMember::inside()->orderBy('updated_at', 'desc')->take(6)->get();
        $membersLatestOut = KnessetMember::outside()->orderBy('updated_at', 'desc')->take(6)->get();

        return view('pages.index', compact('membersInside', 'membersLatestIn', 'membersLatestOut'));
    }

    /**
     * Return about page.
     *
     * @return mixed
     */
    public function about()
    {
        return view('pages.about');
    }

    /**
     * Return contact page.
     *
     * @return mixed
     */
    public function contact()
    {
        return view('pages.contact');
    }
}
