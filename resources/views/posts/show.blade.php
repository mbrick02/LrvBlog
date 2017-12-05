@extends('layouts.master')

@section('content')
  <div class="col-sm-8 blog-main">
    <h1>{{ $post->title }}</h1>

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

    {{-- Add a comment --}}
    <div class="card"> <!-- twitter bootstrap 4 class -->
      <div class="card-block">
        <form method="POST" action="/posts/{{ $post->id }}/comments">
          {{ csrf_field() }}
          <div class="form-group">
            <textarea name="body" placeholder="Your comment here"
            class="form-control" required></textarea>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary">Add Comment</button>
          </div>
        </form>

        @include('layouts.errors')
      </div>
    </div>

  </div>
@endsection
