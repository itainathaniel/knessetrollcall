<?php

namespace App\Http\Controllers;

use App\KnessetMember;
use App\Tweet;

class TweetsController extends Controller
{
    /**
     * Display a listing of the resource.
     * GET /tweets.
     *
     * @return Response
     */
    public function index()
    {
        $tweets = Tweet::latest()->take(100)->get();

        return view('tweets.index', compact('tweets'));
    }

    /**
     * Display the specified resource.
     * GET /tweets/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tweet = Tweet::whereId($id)->firstOrFail();

        $metadata = json_decode($tweet->metadata, 1);

        $knessetMembers = [];
        if (isset($metadata)) {
            $knessetMembers = KnessetMember::whereIn('id', $metadata['ids'])->get();
        }

        return view('tweets.show', compact('tweet', 'knessetMembers'));
    }
}
