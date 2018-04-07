@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">

            @foreach($events as $event)
            
            <div class="col-md-4 p-3">
                <a href="{{ $event->path() }}">
                    <div class="card bg-dark text-white" style="font-family:Comic Sans MS, cursive, sans-serif">
                        <!-- <img class="card-img" src="{{ url('/photos/' .$event->thumbnail_path) }}" style="opacity:0.2;"> -->
                        <img class="card-img" src="{{ $event->thumbnail_path }}" style="opacity:0.2;">
                        <div class="card-img-overlay">
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