<?php

namespace App\Http\Controllers;

use App\Event;
use App\Filters\EventFilters;
use App\Http\Requests\PublishEventRequest;
use Intervention\Image\Facades\Image;

class EventController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only(['create','store','edit','update','destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(EventFilters $filters)
    {
        $events = Event::with('creator')->filter($filters)->latest()->paginate(24);

        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PublishEventRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PublishEventRequest $request)
    {
        $event = auth()->user()->addEvent($request->all());

        return redirect(route('events.show', $event));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        $event = $event->load(['photos', 'favorites']);
        
        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        $this->authorize('update',$event);
        
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PublishEventRequest  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(PublishEventRequest $request, Event $event)
    {
        $this->authorize('update',$event);

        if($request->thumbnail_path != null ) {
            $image = $request->thumbnail_path;
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('photos/' . $filename);
            // width - height
            Image::make($image)->resize(640, 480)->save($location);
        }

        $event->update([
            'name' => $request->name,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'time' => $request->time,
            'contact' => $request->contact,
            'venue' => $request->venue ,
            'type' => $request->type,
            'thumbnail_path' => $request->thumbnail_path? $filename: $event->thumbnail_path

        ]);

        return redirect(route('events.show', $event));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $this->authorize('update',$event);
        
        $event->delete();

        return back();
    }
}
