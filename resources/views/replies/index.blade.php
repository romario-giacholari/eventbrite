@foreach($replies as $reply)
<div class="card mt-3">
  <div class="card-header">
    <div class="d-flex justify-content-space-around">
        <span class="mr-auto"> {{ $reply->owner->name }} said ... </span>
        @auth
          <favorite class="mr-right" :data="data"></favorite>
         @endauth
    </div>
  </div>
  <div class="card-body">
    <p class="card-text">{{ $reply->body }}</p>
  </div>
  @can('update', $reply)
  <div class="card-footer text-muted">
    <button class="btn btn-xs mr-1">Edit</button>
    <button class="btn btn-xs btn-danger">Delete</button>
  </div>
  @endcan
</div>
@endforeach

@include('replies.create')