<?php

namespace App\Http\Controllers;

use App\Reply;

class FavoriteReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Reply $reply
     * @return \Illuminate\Http\Response
     * @internal param \Illuminate\Http\Request $request
     */
    public function store(Reply $reply)
    {
        $reply->favorite();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Reply $reply
     * @return \Illuminate\Http\Response
     * @internal param \App\Favorite $favorite
     */
    public function destroy(Reply $reply)
    {
        $reply->unfavorite();
    }
}
