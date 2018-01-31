@extends('layouts.master')

@section('content')
<script type="text/javascript">

	function xxxletUserEditPostxxx___retrievTitleNOpenTagsForm() {		
		// window.open('/tags/create');  -- instead we POST to tags/create route
		document.showEditForm.method = "getORPatch"; 
		 // TODO: want to open (web.php) Route::get('/tags/create', 'TagsController@create'); 
		document.showEditForm.action ="/post/edit";
		document.showEditForm.submit();
		
		return true;
	}
//
</script>
  <div class="col-sm-8 blog-main">
    <h1>{{ $post->title }} by {{ $post->user->fname }} {{ $post->user->lname }}</h1>
    <h2>by {{ $post->user->fname }} {{ $post->user->lname }}</h2>

    @if (count($post->tags))
      <ul>
        @foreach ($post->tags as $tag)
          <li><a href="/posts/tags/{{$tag->name}}">{{$tag->name }}</a></li>
        @endforeach
      </ul>
    @endif

    {{$post->body}}
    <hr />

    <div class="comments">
      <h2>Comments:</h2>
      <ul class="list-group">
        @foreach ($post->comments as $comment)
          <li class="list-group-item">
            <strong>{{ $comment->created_at->diffForHumans() }}:</strong> &nbsp;
            {{$comment->body }}</li>
        @endforeach
      </ul>
    </div>
    
    @if (Auth::check())
    {{-- Add a comment if auth/logged-in --}}
    <div class="card"> <!-- twitter bootstrap 4 class -->
      <div class="card-block">
        <form method="POST" action="/posts/{{ $post->id }}/comments" name="letUserEditPost">
          {{ csrf_field() }}
          <div class="form-group">
            <textarea name="body" placeholder="Your comment here"
            class="form-control" required></textarea>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary">Add Comment</button>
            @if (($post->user->id) == (auth()->user()->id))
            	<!-- let author edit post -->
            	<button type="button" class="btn btn-primary" id="editBtn">Edit Post</button>
            @endif
          </div>
        </form>

        @include('layouts.errors')
      </div>
    </div>
    @endif

  </div>
@endsection
