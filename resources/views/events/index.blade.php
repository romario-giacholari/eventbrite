@extends('layouts.app')
@section('content')
    <div class="container">
         <div class="d-flex justify-content-between align-items-center">
             <a href="/events/create" class="btn btn-lg btn-success add-button mr-auto" title="add event"><i class="fa fa-plus" aria-hidden="true"></i></a>
             <h1 class="mr-auto heading">Events</h1> 
        </div>
        <hr />
        <div class="row">
            @foreach($events as $event)
            <div class="col-md-4 p-3">
                <a href="{{ $event->path() }}">
                    <div class="card bg-dark text-white" style="font-family:Comic Sans MS, cursive, sans-serif">
                        <img class="card-img" src="{{ url('/photos/' .$event->thumbnail_path) }}" style="opacity:0.2;">
                        <!-- <img class="card-img" src="{{ $event->thumbnail_path }}" style="opacity:0.2;"> -->
                        <div class="card-img-overlay  event-thumbnail">
                            <h5 class="card-title">title: {{ $event->name }}</h5>
                            <p class="card-text"> venue: {{ $event->venue }}</p>
                            <p class="card-text">type: {{ $event->type }}</p>
                            <p class="card-text">likes: {{ $event->favorites_count }}</p>
                            <p class="card-text">due date: {{ $event->due_date }}</p>
                        </div>
                    </div>
                </a>
            </div>

            @endforeach 

        </div>

        {{$events->links()}}

    </div>

@endsection