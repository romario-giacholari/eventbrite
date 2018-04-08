@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
        <form class="mt-3" action="{{ route('reply.update', $reply) }}" method="POST">
                {{ csrf_field() }}
                {{method_field('PATCH')}}
                
                <div class='form-group'>
                    <textarea name='body' id='body' class='form-control' 
                            placeholder="Have something to say?"
                            rows="5" required>{{$reply->body}}</textarea>
                </div>
                <div class='form-group'>
                    <button  class="btn btn-primary btn-block">
                        update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection