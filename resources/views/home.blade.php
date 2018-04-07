@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                <th scope="col">Event_Name</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                <tr>
                <td><a href="{{ route('events.show', $event) }}"> {{ $event->name}} </a> </td>
                <td><a href="{{ route('events.edit', ['event' => $event] ) }}" class="text-dark" style="text-decoration:none">edit</a></td>
                <td>
                    <form action="{{ route('events.destroy', ['event' => $event] ) }}" method="POST">
                        {{method_field('DELETE')}}

                        {{csrf_field()}}
                        <a href="#" onclick="$(this).closest('form').submit()" class="text-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    </form>
                </td>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
