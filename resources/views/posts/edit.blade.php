@extends('layouts.master')

@section('content')
<script type="text/javascript">

	function openTagsForm() {
		document.postEditForm.method = "get";  // want to open (web.php) Route::get('/tags/create', 'TagsController@create'); 
		document.postEditForm.action ="/tags/{{ $post->id }}/create";
		document.postEditForm.submit();
		
		return true;
	}
//
</script>
<div class="col-sm-8 blog-main">
<h1>Edit a Post</h1>

<hr>
// ***************Based on combo of Create view/posts/create.blade.php &  show.blade.php (see below *****...) 
NOT AN HTML COMMENT REMOVE ****** // ***************************************
<form method="POST" action="/posts/{{ $post->id }}/edit" name="postEditForm">
{{ csrf_field() }}
{{ method_field('PATCH') }} 
@php
  $restoreBody = session('postBody', '') ?: (session('postBody') ?: $post->body);
  $restoreTitle = session('postTitle', '') ?: (session('postTitle') ?: $post->title);  
  	
  session()->forget('postTitle'); // clear old to get new field val if we leave the page
  session()->forget('postBody');
@endphp

<div class="form-group">
<input type="hidden" name="form_type" value="editPostForm">
<label for="title">Title:</label>
<input type="text" class="form-control" id="title" placeholder="Title"
    name="title" value="{{ $restoreTitle }}" required>
    </div>
    <div class="form-group">
    <div class="tag-cloud">
    <fieldset class="tag-cloud">
    <legend class="tag-cloud">Tags to group by</legend>
    <div class="tag-item clearfix">
   
 	{{-- TODO: test for existing tags 2/16/18 --}}
    @if (count($post->tags)) // *** or $post->tags->count() ?? >0 ???
  		@php	$postTags = array(); @endphp
    	@foreach ($post->tags as $setTag)
    		@php
    			array_push($postTags, $setTag->name);
    		@endphp
    	@endforeach		
    @endif
    
    @foreach ($tags as $tag)
        <span class="tag-item">
        <input type="checkbox" name="tags[]" value="{{$tag->name}}"
        id="{{$tag->name}}"
			@if (isset($postTags) && (in_array($tag->name, $postTags))) {{-- check if already in post-tags --}}
			 checked
			@endif
        >
        <label for="{{$tag->name}}">{{$tag->name}}</label>
        </span>
     @endforeach
        </div>
        </fieldset>
        <fieldset class="tag-button">
        <!-- button to open tag create form holding form info in session var -->
        <button class="button" type="button"
            onClick="return openTagsForm();">
            <span class="icon">Add Tags</span></button>
            </fieldset>
            </div>
            </div>
            
            <div class="form-group">
            <label for="body">Body:</label>
            <textarea id="body" name="body" class="form-control"
                required>{{$restoreBody}}</textarea>
            </div>
            
            <div class="form-group">
            <button type="submit" class="btn btn-primary">Update</button>
            </div>
        @include('layouts.errors')
        </form>
    </div>
@endsection