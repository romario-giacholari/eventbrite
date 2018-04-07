@auth
<form class="mt-3" action="{{ route('reply.store', $event) }}" method="POST">
    {{ csrf_field() }}
    
    <div class='form-group'>
        <textarea name='body' id='body' class='form-control' 
                placeholder="Have something to say?"
                rows="5" required></textarea>
    </div>
    <div class='form-group'>
        <button  class="btn btn-primary btn-block">
            Post
        </button>
    </div>
</form>
@else
<p>
    <a href="/login">
        Please sign in to participate in this discussion
    </a>
</p>
@endauth