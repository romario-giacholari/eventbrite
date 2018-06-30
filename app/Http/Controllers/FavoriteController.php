<?php

namespace App\Http\Controllers;

use App\Event;

class FavoriteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Event $event
     * @return \Illuminate\Http\Response
     * @internal param \Illuminate\Http\Request $request
     */
    public function store(Event $event)
    {
        $event->favorite();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Event $event
     * @return \Illuminate\Http\Response
     * @internal param \App\Favorite $favorite
     */
    public function destroy(Event $event)
    {
        $event->unfavorite();
    }
}
