<?php namespace KnessetRollCall\Http\Controllers;

use KnessetRollCall\Http\Requests;
use KnessetRollCall\Http\Requests\PageRequest;
use KnessetRollCall\Http\Controllers\Controller;
use KnessetRollCall\KnessetMember;

class PagesController extends Controller {

    public function index()
    {
        $membersInside = KnessetMember::where('isInside', '=', true)->get();

        $membersLatestIn  = KnessetMember::where('isInside', '=',  true)->orderBy('updated_at', 'desc')->take(6)->get();
        $membersLatestOut = KnessetMember::where('isInside', '=', false)->orderBy('updated_at', 'desc')->take(6)->get();

        return view('pages.index', compact('membersInside', 'membersLatestIn', 'membersLatestOut'));
    }

    /**
     * Return about page
     *
     * @return mixed
     */
    public function about()
    {
        return view('pages.about');
    }

    /**
     * Return contact page
     *
     * @return mixed
     */
    public function contact()
    {
        return view('pages.contact');
    }

}