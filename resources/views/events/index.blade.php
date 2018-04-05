@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            @foreach($events as $event)
            <div class="col-md-4">
                <div class="thumbnail">
                    <a href="{{ $event->path() }}">
                        <img src="{{ $event->photos[0]->path}}" style="width:100%" class="event-thumbnail">
                    </a>
                        <div class="caption">
                            <p>{{ $event->name }}</p>
                        </div>
                </div>
            </div>
            @endforeach
        </div>

        {{$events->links()}}
    </div>

@endsection