@foreach($replies as $reply)
<div class="card mt-3">
  <div class="card-header">
    <div class="d-flex justify-content-space-around">
        <span class="mr-auto"> {{ $reply->owner->name }} said ... </span>
        @auth
          <favorite-reply class="mr-right" :reply="{{ $reply }}"></favorite-reply>
         @endauth
    </div>
  </div>
  <div class="card-body">
    <p class="card-text">{{ $reply->body }}</p>
  </div>
  @can('update', $reply)
  <div class="card-footer text-muted">
    <a href="{{route('reply.edit',['reply' => $reply, 'event' => $event])}}">edit</a>
    <form action="{{route('reply.destroy',$reply)}}" method="POST">
        {{method_field('DELETE')}}
        {{csrf_field()}}
      <a href="#" onclick="$(this).closest('form').submit()" style="color:red">delete</a>
    </form>
  </div>
  @endcan
</div>
@endforeach

@include('replies.create')