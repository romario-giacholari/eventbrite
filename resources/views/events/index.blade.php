@extends('layouts.app')
@section('content')
    <div class="container">
         <div class="d-flex justify-content-between align-items-center">
             @auth
                 <a href="/events/create" class="btn btn-lg btn-success add-button mr-auto" title="add event"><i class="fa fa-plus" aria-hidden="true"></i></a>
             @endauth
             <h1 class="mr-auto heading">Events</h1> 
        </div>
        
        <hr />

        <div class="row">
            @if(count($events))
                @foreach($events as $event)
                <div class="col-md-4 p-3">
                        <div class="card" style="font-family:Comic Sans MS, cursive, sans-serif">
                            <a href="{{ $event->path() }}">
                                 <img class="card-img event-thumbnail" src="{{ url('/photos/' .$event->thumbnail_path) }}">
                            </a>
                            <div class="card-body ">
                                <h5 class="card-title">title: {{ $event->name }}</h5>
                                <p class="card-text"> venue: {{ $event->venue }}</p>
                                <p class="card-text">type: {{ $event->type }}</p>
                                <p class="card-text">likes: {{ $event->favorites_count }}</p>
                                <p class="card-text">due date: {{ \Carbon\Carbon::parse($event->due_date)->diffForHumans() }}</p>
                            </div>
                        </div>
                   
                </div>
                @endforeach 
            @else
                <div class="col-md-4 p-3">
                    <p>No events.</p>
                    <a href="{{ url()->previous() }}" class="btn btn-outline-success">back</a>
                </div>
            @endif

        </div>

        {{$events->links()}}

    </div>

@endsection