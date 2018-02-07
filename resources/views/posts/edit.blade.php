<?php
@extends('layouts.master')

@section('content')

<div class="col-sm-8 blog-main">
<h1>Edit a Post</h1>

<hr>
// ***************Based on combo of Create view/posts/create.blade.php &  show.blade.php (see below *****...) 
NOT AN HTML COMMENT REMOVE ****** // ***************************************
<form method="POST" action="/posts" name="postEditForm">
{{ method_field('PATCH') }} 
{{ csrf_field() }}


<div class="form-group">
<label for="title">Title:</label>
<input type="text" class="form-control" id="title" placeholder="Title"
    name="title" value="{{ $post->title }}" required>
    </div>
    <div class="form-group">
    <div class="tag-cloud">
    <fieldset class="tag-cloud">
    <legend class="tag-cloud">Tags to group by</legend>
    <div class="tag-item clearfix">
    @foreach ($tags as $tag)  ****NEED TO ADD SOME FORM OF IF POST_TAG CHECKED THEN CHECK ******
        <span class="tag-item">
        <input type="checkbox" name="tags[]" value="{{$tag->name}}"
        id="{{$tag->name}}">
        <label for="{{$tag->name}}">{{$tag->name}}</label>
        </span>
        @endforeach
        </div>
        </fieldset>
        <fieldset class="tag-button">
        <!-- button to open tag create form holding form info in session var -->
        <button class="button" type="button"
            onClick="return retrievTitleNOpenTagsForm();">
            <span class="icon">Create New Tag</span></button>
            </fieldset>
            </div>
            </div>
            
            <div class="form-group">
            <label for="body">Body:</label>
            <textarea id="body" name="body" class="form-control"
                required>
                {{$post->body}}</textarea>
            </div>
            
            <div class="form-group">
            <button type="submit" class="btn btn-primary">Publish</button>
            </div>
        @include('layouts.errors')
        </form>
    </div>
@endsection

NOT AN HTML COMMENT REMOVE ****** // ***************************************
NOT AN HTML COMMENT REMOVE *** *** // ****************** OLD SHOW.BLADE.PHP

@extends('layouts.master')

@section('content')

<div class="col-sm-8 blog-main">
xxxTITLE SHOULD BE DONE ****XXXX<h1>{{ $post->title }} by {{ $post->user->fname }} {{ $post->user->lname }}</h1>
<h2>by {{ $post->user->fname }} {{ $post->user->lname }}</h2>

@if (count($post->tags))
    <ul>
    @foreach ($post->tags as $tag)
        <li><a href="/posts/tags/{{$tag->name}}">{{$tag->name }}</a></li>
        @endforeach
        </ul>
        @endif
        
*****BODY SHOULD BE DONE****XXXX        {{$post->body}}
        <hr />
   ****SHOULDNT NEED COMMENTS FOR THE EDIT     
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
REMOVE NOT AN HTML COMMENT *** // ****************** END OLD SHOW.BLADE.PHP




                
                
                